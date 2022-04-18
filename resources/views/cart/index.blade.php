@extends('layouts.base')

@section('header')
    @include('components.header')
@endsection

@section('main')

    <div class="container-md bg-light rounded">
        <div class="bb-cart">
            <h2 class="bb-cart-h4">Моя корзина</h2>

            <div id="allCardsContainer"></div>

            <div class="bb-cart-product__sum-out"></div>

        </div>
    </div>


    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                $(function () {
                    let cart_gl = new ShoppingCartBB(
                        "{{ route('cart.index')}}",
                        "{{ route('cart.render')}}",
                        "{{ route('add_to_cart')}}",
                        "{{ route('cart.update')}}",
                        "{{route('remove_from_cart')}}",
                        "{{asset('/storage/uploads')}}",
                        "{{csrf_token()}}"
                    );

                    cart_gl.showTotalQuantity('{{\Cart::session(\Illuminate\Support\Facades\Session::getId())->getTotalQuantity()}}')
                    cart_gl.addProductToCart()
                    cart_gl.cartRender();
                })
            })
        </script>
    @endpush

@endsection
@section('footer')
    @include('components.footer')
@endsection






<style>
    .bb-cart-product {
        display: flex;
        flex-direction: column;
        background-color: #ffffff;
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 20px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .bb-cart-product-details {
        display: flex;
        flex-direction: row;
        /*border: solid #3fc24c 1px;*/
    }

    .bb-cart-product__description {
        display: flex;
        flex: 1 1 auto;
        /*background-color: #ab2836;*/
     align-items: center;
        padding-left: 20px;
    }

    .bb-cart-product__title {
        font-size: 18px;
        line-height: 24px;
    }

    .bb-cart-product__img-holder {
        /*border: solid #214cda 2px;*/
    }

    .bb-cart-product__img {
        width: 100px;
        height: auto
    }

    .bb-cart-product__info {
        /*border: solid #7421da 2px;*/
        display: flex;
        flex: 1 1 auto;
        /*background-color: #9525e1;*/
    }

    .bb-cart-product__price{
        background-color: #efeeee;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 130px;
        border-radius: 10px;
        box-shadow: rgba(205, 205, 215, 0.25) 0px 30px 60px -12px inset, rgba(150, 150, 150, 0.3) 0px 18px 36px -18px inset;
        margin-left: 20px;
    }

    .bb-cart-product__price-value {
        font-size: 18px;
        padding-bottom: 10px;
        font-weight: bold;
        color: #474c50;

    }

    .bb-cart-product__footer {
        /*border: solid #d3b84e 2px;*/
        border-top: rgba(173, 173, 173, 0.84) 1px dotted;
        margin-top: 10px;
    }

    .shopping-cart__delete-btn{
        margin-top: 10px;
        border: 0px;
        padding: 6px;
        padding-left: 11px;
        padding-right: 11px;
        border-radius: 9px;
        background-color: #d3dbdc;
        transition: background-color .5s;
    }

    .shopping-cart__delete-btn:hover{
        background-color: #cdd2d3;
    }

    .bb-cart-product__price-count {
        display: flex;
        /*background-color: #58c963;*/
    }

    .bb-cart-product__price-count-btn {
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #2b3234;
        width: 30px;
        height: 30px;
        cursor: pointer;
    }
    .bb-cart-product__price-count-btn:hover{
        background-color: #262a2d;

    }

    .bb-cart-product__price-count-btn_left {
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
    }

    .bb-cart-product__price-count-btn_right {
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
    }

    .bb-cart-product__product-input {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        /*border: #0c63e4 1px solid;*/
        height: auto;
        max-width: 50px;
        padding-left: 5px !important;
        padding-right: 5px !important;
        text-align: center;
        outline: none;
        border: 0px;
        border-left: 0;
        border-right: 0;
    }

    .bb-cart-product__sum-out{
        margin-top: 20px;
        padding-bottom: 10px;
    }

    .bb-cart-h4{
        padding-top: 20px;
        margin-bottom: 20px;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
