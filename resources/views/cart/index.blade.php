@extends('layouts.base')

@section('header')
    @include('components.header')
@endsection

@section('main')

    <div class="container-md bg-light rounded">
        <div class="bb-cart">
            <h2>Моя корзина</h2>

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
        background-color: #ffe3e5;
        margin-bottom: 20px;
    }

    .bb-cart-product-details {
        display: flex;
        flex-direction: row;
        border: solid #3fc24c 1px;
    }

    .bb-cart-product__description {
        display: flex;
        flex: 1 1 auto;
        background-color: #ab2836;
    }

    .bb-cart-product__title {
        font-size: 20px;
    }

    .bb-cart-product__img-holder {
        border: solid #214cda 2px;
    }

    .bb-cart-product__img {
        width: 100px;
        height: auto
    }

    .bb-cart-product__info {
        border: solid #7421da 2px;
        display: flex;
        flex: 1 1 auto;
        background-color: #9525e1;
    }


    .bb-cart-product__price-value {
        font-size: 20px;
    }

    .bb-cart-product__footer {
        border: solid #d3b84e 2px;
    }

    .bb-cart-product__price-count {
        display: flex;
        background-color: #58c963;
    }

    .bb-cart-product__price-count-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #86b7fe;
        border: #0c63e4 1px solid;
        width: 30px;
        height: 30px;
        cursor: pointer;
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
        background-color: #faba60;
        border: #0c63e4 1px solid;
        height: auto;
        max-width: 40px;
        padding-left: 5px !important;
        padding-right: 5px !important;
        text-align: center;
        outline: none;
        border-left: 0;
        border-right: 0;
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
