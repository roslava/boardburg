class ShoppingCartBB {

    constructor(urlCardIndex, urlCardRender, urlAddToCard, urlCartUpdate, urlRemoveFromCard, uploadsFolderUrl, csrf_token) {

        if (urlCartUpdate === undefined) urlCartUpdate = false;
        this.urlCardIndex = urlCardIndex;
        this.urlCardRender = urlCardRender;
        this.urlAddToCard = urlAddToCard;
        this.urlCartUpdate = urlCartUpdate;
        this.urlRemoveFromCard = urlRemoveFromCard;
        this.uploadsFolderUrl = uploadsFolderUrl;
        this.csrf_token = csrf_token;
    }

    showTotalQuantity(totalQuantity) {
        let cartCountHolders = Array.from(document.getElementsByClassName('bb-cart-count'));
        cartCountHolders.forEach(function (item) {
            item.innerHTML = totalQuantity
        })
    }

    sowTotalSum(data){
        let bbCartProductSumOut = document.querySelectorAll('.bb-cart-product__sum-out');
        if (data > 0){
            bbCartProductSumOut.forEach(item => {
                item.innerHTML = 'Общая стоимость покупок: <b> ' + data + ' руб.</b>'
            })
        }
        if (data == 0){
            bbCartProductSumOut.forEach(item => {
                item.innerHTML = 'Ваша корзина пуста.'
            })
        }
    }

    addProductToCart() {
        let btnAddToCartCollection = document.getElementsByClassName('shopping_cart_btn');
        let btnAddToCart = Array.from(btnAddToCartCollection);
        btnAddToCart.forEach(item => {
            item.addEventListener('click', () => {
                let id = item.dataset.id
                fetch(this.urlAddToCard + '?id=' + id)
                    .then(data => {
                        return data.json()
                    })
                    .then(data => {
                        this.showTotalQuantity(data['totalQuantity'])
                        let cartAddConfirmTitle = document.querySelector('#cartAddConfirmTitle');
                        // console.log(cartAddConfirmTitle)
                        cartAddConfirmTitle.innerHTML = data['isAddedToCartMessage']['isAddedToCartMessage'];
                    })
                    .then(() => {
                        let shoppingCartDeleteBtn = document.querySelectorAll('.shopping-cart__delete-btn-hid');
                        shoppingCartDeleteBtn.forEach(item => {
                            item.value = id
                            let shoppingCartCeleteBtn_ = document.querySelectorAll('.shopping-cart__delete-btn_');
                            shoppingCartCeleteBtn_.forEach(item => {
                                item.dataset.this_id = id
                            })
                        })
                    })
            })
        })
    }

    removeProductFromCart() {
        const ajaxSend = async (formData) => {
            await fetch(this.urlRemoveFromCard, {
                method: 'POST',
                credentials: "same-origin",
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(data => {
                return data.json()
            }).then(data => {
                // console.log(data)
                this.showTotalQuantity(data['totalQuantity'])
                if (document.location.href == this.urlCardIndex) {
                                  this.cartRender()
                }
            })
        };

        const forms = document.querySelectorAll('.shopping-cart__delete-btn-form');
        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                ajaxSend(formData)
                    .catch((err) => console.error(err))
            });
        });
    }

    cartUpdate(sign, id, cartProductCounterClass){
            fetch(this.urlCartUpdate, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    sign: sign,
                    id:id
                })
            })
                .then(data => {
                    return data.json()
                })
                .then((data) => {
                    console.log('ответ от сервера — знак:', data['sign']);
                    console.log('ответ от сервера — количество:', data['itemQuantity']);
                    console.log('ответ от сервера — id:', data['id']);
                    console.log('ответ от сервера — общая цена:', data['priceSum']);
                    this.showTotalQuantity(data['totalQuantity']);
                    this.sowTotalSum(data['sum']);
                    document.getElementsByClassName(cartProductCounterClass)[2].value = data['itemQuantity']
                    document.getElementsByClassName(cartProductCounterClass)[0].innerHTML = data['priceSum'] + ' руб.'
                })
                .catch(function(error) {
                    console.log(error);
                });
    }


    cartRender() {
        fetch(this.urlCardRender)
            .then(data => {
                return data.json()
            })
            .then(data => {
                this.sowTotalSum(data['sum'])
                this.cartIndex(data['cartItems'], this.csrf_token)
                this.sowTotalSum('sum')
            })
    }


    cartIndex(cart, csrf_cur) {
        let allCardsContainer = document.querySelector('#allCardsContainer')
        if (allCardsContainer.hasChildNodes()) {
            allCardsContainer.innerHTML = '';
        }
        for (let key in cart) {
            function uniqueClassNameGenerator(){
                function randomInteger(min, max) {
                    let rand = min - 0.5 + Math.random() * (max - min + 1);
                    return Math.round(rand);
                }
                return randomInteger(1, 100) + "_" + cart[key].id;
            }
            let cartProductCounterClass = uniqueClassNameGenerator()

            //CREATE bbCartProduct
            let bbCartProduct = document.createElement('div');
            bbCartProduct.dataset.product_id = cart[key].id;
            bbCartProduct.classList.add("bb-cart-product");
            allCardsContainer.append(bbCartProduct);

            //CREATE bbCartProductDetails
            let bbCartProductDetails = document.createElement('div');
            bbCartProductDetails.classList.add("bb-cart-product-details");
            bbCartProduct.prepend(bbCartProductDetails);

            //CREATE bbCartProductImgHolder
            let bbCartProductImgHolder = document.createElement('div');
            bbCartProductImgHolder.classList.add("bb-cart-product__img-holder");
            bbCartProductDetails.prepend(bbCartProductImgHolder);

            //CREATE bbCartProductImg
            let bbCartProductImg = document.createElement('img');
            bbCartProductImg.src = this.uploadsFolderUrl + '/' + cart[key]['attributes']['image']
            bbCartProductImg.classList.add("bb-cart-product__img");
            bbCartProductImgHolder.append(bbCartProductImg);

            //CREATE bbCartProductInfo
            let bbCartProductInfo = document.createElement('div');
            bbCartProductInfo.classList.add("bb-cart-product__info");
            bbCartProductDetails.append(bbCartProductInfo);

            //CREATE bbCartProductDescription
            let bbCartProductDescription = document.createElement('div');
            bbCartProductDescription.classList.add("bb-cart-product__description");
            bbCartProductInfo.prepend(bbCartProductDescription);

            //CREATE bbCartProductTitle
            let bbCartProductTitle = document.createElement('div');
            bbCartProductTitle.classList.add("bb-cart-product__title");
            let productName = document.createTextNode(cart[key].name);
            bbCartProductTitle.appendChild(productName);
            bbCartProductDescription.prepend(bbCartProductTitle);

            //CREATE bbCartProductPrice
            let bbCartProductPrice = document.createElement('div');
            bbCartProductPrice.classList.add("bb-cart-product__price");
            bbCartProductInfo.appendChild(bbCartProductPrice);

            //CREATE bbCartProductPriceValue
            let bbCartProductPriceValue = document.createElement('div');
            bbCartProductPriceValue.classList.add("bb-cart-product__price-value", cartProductCounterClass);
            let priceValue = document.createTextNode(cart[key].price + ' руб.');
            bbCartProductPriceValue.appendChild(priceValue);
            bbCartProductPrice.prepend(bbCartProductPriceValue);

            //CREATE bbCartProductPriceCount
            let bbCartProductPriceCount = document.createElement('div');
            bbCartProductPriceCount.classList.add("bb-cart-product__price-count");
            bbCartProductPrice.append(bbCartProductPriceCount);

            //CREATE bbCartProductPriceCountBtnLeft
            let bbCartProductPriceCountBtnLeft = document.createElement('div');
            bbCartProductPriceCountBtnLeft.dataset.unic_data = cartProductCounterClass;
            bbCartProductPriceCountBtnLeft.dataset.sign = "–";
            bbCartProductPriceCountBtnLeft.classList.add(cartProductCounterClass, "bb-cart-product__price-count-btn", "bb-cart-product__price-count-btn_left", "bb-cart-minus");
            let bbCartMinus = document.createTextNode('–');
            bbCartProductPriceCountBtnLeft.appendChild(bbCartMinus);
            bbCartProductPriceCountBtnLeft.onclick = () =>{
                this.cartUpdate('–', cart[key].id, cartProductCounterClass)
            }
            bbCartProductPriceCount.prepend(bbCartProductPriceCountBtnLeft);

            //CREATE bbCartProductProductInput
            let bbCartProductProductInput = document.createElement("INPUT");
            bbCartProductProductInput.setAttribute("type", "number");
            bbCartProductProductInput.setAttribute("id", "bb-cart-quantity-input");
            bbCartProductProductInput.setAttribute("value", cart[key].quantity);
            bbCartProductProductInput.setAttribute("min", '1');
            bbCartProductProductInput.setAttribute("max", '100');
            bbCartProductProductInput.classList.add(cartProductCounterClass, "bb-cart-product__product-input");
            bbCartProductPriceCount.append(bbCartProductProductInput);

            //CREATE bbCartProductPriceCountBtnRight
            let bbCartProductPriceCountBtnRight = document.createElement('div');
            bbCartProductPriceCountBtnRight.dataset.unic_data = cartProductCounterClass;
            bbCartProductPriceCountBtnRight.dataset.sign = "+";
            bbCartProductPriceCountBtnRight.classList.add(cartProductCounterClass, "bb-cart-product__price-count-btn", "bb-cart-product__price-count-btn_right", "bb-cart-plus");
            let bbCartPlus = document.createTextNode('+');
            bbCartProductPriceCountBtnRight.appendChild(bbCartPlus);
            bbCartProductPriceCountBtnRight.onclick = () =>{
                this.cartUpdate('+', cart[key].id, cartProductCounterClass)
            }
            bbCartProductPriceCount.append(bbCartProductPriceCountBtnRight);

            //CREATE bbCartProductFooter
            let bbCartProductFooter = document.createElement('div');
            bbCartProductFooter.classList.add("bb-cart-product__footer");
            bbCartProduct.append(bbCartProductFooter);

            //CREATE shoppingCartDeleteBtnForm
            let shoppingCartDeleteBtnForm = document.createElement("FORM");
            shoppingCartDeleteBtnForm.setAttribute("method", "POST");
            shoppingCartDeleteBtnForm.classList.add("shopping-cart__delete-btn-form");
            bbCartProductFooter.prepend(shoppingCartDeleteBtnForm);

            //CREATE csrf
            let csrf_token = document.createElement('input');
            csrf_token.setAttribute("type", "hidden");
            csrf_token.setAttribute("name", "_token");
            csrf_token.setAttribute("value", csrf_cur)
            shoppingCartDeleteBtnForm.prepend(csrf_token);

            //CREATE shoppingCartDeleteBtn-hid
            let shoppingCartDeleteBtnHid = document.createElement("INPUT");
            shoppingCartDeleteBtnHid.setAttribute("type", "hidden");
            shoppingCartDeleteBtnHid.setAttribute("value", cart[key].id);
            shoppingCartDeleteBtnHid.setAttribute("id", 'id');
            shoppingCartDeleteBtnHid.setAttribute("name", 'id');
            shoppingCartDeleteBtnHid.classList.add("shopping-cart__delete-btn-hid");
            shoppingCartDeleteBtnForm.append(shoppingCartDeleteBtnHid);

            //CREATE shoppingCartDeleteBtn
            let shoppingCartDeleteBtn = document.createElement("button");
            shoppingCartDeleteBtn.classList.add("shopping-cart__delete-btn");
            let bbCartButtonValue = document.createTextNode('Убрать товар из корзины');
            shoppingCartDeleteBtn.appendChild(bbCartButtonValue);
            shoppingCartDeleteBtnForm.appendChild(shoppingCartDeleteBtn);

            this.removeProductFromCart();
        }
    }
}

export default ShoppingCartBB;
window.ShoppingCartBB = ShoppingCartBB;
