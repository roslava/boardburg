@extends('layouts.base')
@section('header')
    @include('components.header')
@endsection
@section('main')
    <div class="container-md">
        @if (Auth::guest() )
            <div class="intro-bb">
                <div class="intro-bb__format"> Демонстрационный проект BoardBurg.&ensp;</div>
                <div class="intro-bb__format">Логин:&thinsp;<span class="intro-bb__select">admin@bb.com</span>,&ensp;
                </div>
                <div class="intro-bb__format"> пароль:&thinsp;<span class="intro-bb__select">88888888</span>&ensp;</div>
            </div>
        @endif
        <div class="row mb-3 " style="padding-top: 1.6rem">
            @include('components.product_card')
            <div class="row mt-3"> {{ $productsFromBase->links()}}</div>
            @if (!Auth::guest() )
                @include('components.accordion')
            @endif
            @if (Auth::guest() )
                <div class="mb-3 contacts__btn" data-toggle="modal" data-target="#mailModalCenter">
                    Задать вопрос
                </div>
            @endif
        </div>
    </div>
@endsection
@section('footer')
    @include('components.footer')
@endsection

<!-- Modal -->
@include('components.modal_send_mail')
@include('components.bb-login-modal')
@include('components.shopping_cart.cart_add_confirm_modal')
@include('components.favourites.favourites_modal')

@if (session('isLoginForm'))
    <script>
        $(window).on('load', function () {
            $('#logineModalCenter').modal('show');
            $("#close_login_modal_btn").click(function () {
                $('#logineModalCenter').modal('hide');
            });
        })
    </script>
@endif



<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const btnAddToCartCollection = document.getElementsByClassName('shopping_cart_btn');
        let btnAddToCart = Array.from(btnAddToCartCollection);
        let cartCountHolder = Array.from(document.getElementsByClassName('bb-cart-count'));
        let cartAddConfirmTitle = document.querySelector('#cartAddConfirmTitle');
        let totalQuantity = {{\Cart::session(\Illuminate\Support\Facades\Session::getId())->getTotalQuantity()}};

        function getTotalQuantity(cartCountHolder, totalQuantity) {
            cartCountHolder.forEach(function (item) {
                item.innerHTML = totalQuantity
            })
        }

        getTotalQuantity(cartCountHolder, totalQuantity)
        btnAddToCart.forEach(function (item) {
            item.addEventListener('click', () => {
                let id = item.dataset.id
                fetch('{{ route('add_to_cart')}}?id=' + id)
                    .then(data => {
                        return data.json()
                    })
                    .then(data => {
                        getTotalQuantity(cartCountHolder, data['totalQuantity']);
                        cartAddConfirmTitle.innerHTML = data['isAddedToCartMessage']['isAddedToCartMessage'];
                    })
                    .then(() => {
                        let shoppingCartDeleteBtn = document.querySelectorAll('.shopping-cart__delete-btn');
                        shoppingCartDeleteBtn.forEach(item => {
                            item.value = id

                         let shoppingCartCeleteBtn_  = document.querySelectorAll('.shopping-cart__delete-btn_');
                            shoppingCartCeleteBtn_.forEach(item => {
                                item.dataset.this_id = id
                                console.log('ID:', item.dataset.this_id)
                            })
                        })
                    })

            })
        })
    })
</script>
