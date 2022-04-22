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
{{--@include('components.shopping_cart.cart_add_confirm_modal')--}}


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



@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            $(function () {
                let cart_gl = new ShoppingCartBB(
                    "{{ route('cart.index')}}",
                    "{{ route('cart.render')}}",
                    "{{ route('add_to_cart')}}",
                    "{{ route('cart.update')}}",
                    "{{route('remove_from_cart')}}",
                    "{{route('cart_icons_added')}}",
                    "{{asset('/storage/uploads')}}",
                    "{{csrf_token()}}"
                );

                cart_gl.showTotalQuantity('{{\Cart::session(\Illuminate\Support\Facades\Session::getId())->getTotalQuantity()}}')
                cart_gl.addProductToCart()
                cart_gl.removeProductFromCart()
                cart_gl.removeProductByCartByModal()
                cart_gl.cartIconsAdded()

            let cart_likes = new LikesCartBB(
                "{{ route('like_active_icons')}}",
                "{{ route('likes_count_show')}}",
                "{{ route('like_add')}}",
                "{{ route('like_remove')}}");

            cart_likes.likeAdd()
            cart_likes.likeIndex()
            cart_likes.likeCountClick()

            })
        })
    </script>
@endpush

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){
        $(".shopping_cart_btn").click(function(){
            $("#cart_add_confirm_modal").modal('show');
        });
    });

    $(document).ready(function(){
        $("#cart_add_confirm_modal").submit(function(){
            $("#cart_add_confirm_modal").modal('hide')
        });
    });

    $(document).ready(function(){
        $(".modalCloseConfirm-close-btn").click(function(){
            $("#cart_add_confirm_modal").modal('hide')
        });
    });

</script>

