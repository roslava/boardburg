@extends('layouts.base')
@section('header')
    @include('components.header')
@endsection

@section('main')

    <div class="container-md bg-light rounded">
        <div class="bb-cart">
            <h2>Моя корзина</h2>


           @foreach($cart as $item)


            <div class="bb-cart-product">
                <div class="bb-cart-product-details">
                    <div class="bb-cart-product__img">
                        <img style="width: 100px; height: auto" src="{{asset('/storage/uploads/'.$item->attributes['image'])?? ''}}" alt="">
                    </div>
                    <div class="bb-cart-product__info">
                        <div class="bb-cart-product__description">
                            <div class="bb-cart-product__title">
                                {{$item->name}}
                            </div>
                        </div>
                        <div class="bb-cart-product__price">
                            <div>{{$item->price}} руб.</div>
                            <div class="bb-cart-product__price-count">
                                <div class="bb-cart-product__price-count-btn bb-cart-product__price-count-btn_left bb-cart-plus">+ </div>
                                <input id="bb-cart-quantity-input" class="bb-cart-product__product-input" value="{{$item->quantity}}" type="number"  min="1" max="100">
                                 <div class="bb-cart-product__price-count-btn bb-cart-product__price-count-btn_right bb-cart-minus">-</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bb-cart-product__receiving">Где и как вы хотите получить заказ?</div>
            </div>

{{--                <form action="{{ route('remove_from_cart', $item->id)}}" method="post">--}}
{{--                    @csrf--}}
{{--                    @method("DELETE")--}}
{{--                    <button >--}}
{{--                        Удалить товар из корзины--}}
{{--                    </button>--}}
{{--                </form>--}}




                <form action="{{ route('remove_from_cart') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $item->id }}" name="id">
                    <button class="px-4 py-2 text-white bg-red-600">Удалить товар из корзины</button>
                </form>







            @endforeach

Цена всех покупок: {{$sum}}
        </div>
    </div>

@endsection
@section('footer')
    @include('components.footer')
@endsection


<style>
    .bb-cart-product {
        display: flex;
        flex-direction: column;
        border: solid red 1px;
    }

    .bb-cart-product-details {
        display: flex;
        flex-direction: row;
        border: solid #3fc24c 1px;
    }

    .bb-cart-product__description {
        display: flex;
        flex: 1 1 auto;
    }

    .bb-cart-product__title {
        font-size: 20px;
    }

    .bb-cart-product__img {
        border: solid #214cda 2px;
    }

    .bb-cart-product__info {
        border: solid #7421da 2px;
        display: flex;
        flex: 1 1 auto;
    }

    .bb-cart-product__receiving {
        border: solid #d3b84e 2px;
    }

    .bb-cart-product__price-count {
        display: flex;
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $('.bb-cart-product__product-input').prop('disabled', true);
        $(document).on('click','.bb-cart-plus',function(){
            $('.bb-cart-product__product-input').val(parseInt($('.bb-cart-product__product-input').val()) + 1 );
        });
        $(document).on('click','.bb-cart-minus',function(){
            $('.bb-cart-product__product-input').val(parseInt($('.bb-cart-product__product-input').val()) - 1 );
            if ($('.bb-cart-product__product-input').val() == 0) {
                $('.bb-cart-product__product-input').val(1);
            }
        });
    });
</script>




