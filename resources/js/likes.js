class LikesCartBB {
    constructor(urlLikeIndex, urlLikesCountShow, urlLikeAdd, urlLikeRemove) {
        this.urlLikeIndex = urlLikeIndex;
        this.urlLikesCountShow = urlLikesCountShow;
        this.urlLikeAdd = urlLikeAdd;
        this.urlLikeRemove = urlLikeRemove;
    }


    likeIndex() {
        fetch(this.urlLikeIndex)
            .then(data => {
                return data.json()
            })
            .then(data => {

                let likeIcons = Array.from(document.getElementsByClassName('product-card__like-icon')); //all like icons

                function isArrayLikes(likes) {
                    if (Array.isArray(likes)) {
                        return likes;
                    } else if (typeof likes === 'object') {
                        return Object.values(likes);
                    }
                }

                let activeIdLikes = isArrayLikes(data['likes']) //all active like icons

                if (activeIdLikes === undefined) {
                    console.log('empty')
                } else {
                    likeIcons.forEach(likeIcon => {
                        activeIdLikes.forEach(activeIdLike => {
                            if (activeIdLike === likeIcon.dataset.id) {
                                likeIcon.classList.add("product-card__like_active");
                            }
                        })
                    })
                    this.likeCountOut()
                        .then()
                }
            })
    }


    likeAdd() {
        let likes = Array.from(document.getElementsByClassName('product-card__like-icon'));
        let urlLikeAdd = this.urlLikeAdd
        let urlLikeRemove = this.urlLikeRemove
        likes.forEach(item => {
            item.addEventListener('click', function () {
                if (this.classList.contains("product-card__like_active")) {
                    this.classList.remove("product-card__like_active");
                    setLikes(urlLikeRemove, false, this.dataset.id)

                } else {
                    this.classList.add("product-card__like_active");
                    setLikes(urlLikeAdd, true, this.dataset.id)
                }
            })
        })


        function setLikes(urlValue, value, id) {
            fetch(urlValue, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    isLike: value,
                    id: id,
                })
            })
                .catch(function (error) {
                    console.log(error);
                });
        }
    };


    async likeCountOut() {
        await fetch(this.urlLikesCountShow)
            .then(data => {
                return data.json()
            })
            .then(data => {
                let likeCountOuts = document.querySelectorAll('.bb-like-count-out')
                likeCountOuts.forEach(item => {
                    item.innerHTML = data['likesCount'];
                })
            })
    }


    async likeCountClick(){
        // let likesButtons =  document.querySelectorAll('.product-card__like-icon-for-out')
        let likesButtons = Array.from(document.querySelectorAll('.product-card__like-icon-for-out'))
        likesButtons.forEach(item =>{
            item.addEventListener('click', ()=>{
                 setTimeout(() => {this.likeCountOut()}, 900);
              })
        })
    }
}

export default LikesCartBB;
window.LikesCartBB = LikesCartBB;
