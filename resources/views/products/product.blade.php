@extends('layouts.base')

@section('header')
    @include('components.header')
@endsection

@section('main')
    <div class="container-md bg-light rounded">
        <div class="row p-3 pb-3 pb-lg-5 pb-md-4 pb-sm-3   mb-0 mt-0  mt-lg-4 mb-lg-4 mt-md-3 mb-md-3  " style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;">
            {{--info--}}
            <div class="col-lg-8 col-md-12 col-sm-12 p-0">
                <div class=" m-lg-5 m-md-4  m-sm-3">
                    {{--breadcrumb  --}}
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a style="color: rgb(30,152,95);"
                                                           href="{{ route('products_base.index')}}">Каталог</a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page">{{$productFromBase['name'] ?? '0'}}</li>
                        </ol>
                    </nav>
                    <h1 class="mt-4 bb-product-title">{{$productFromBase['name'] ?? '0'}}</h1>
                    <p>{{$productFromBase['description'] ?? '0'}}</p>


                    <div class="bb-price-tag">
                        <div class="bb-price-tag-price"> {{$productFromBase['price'] ?? '0'}} руб.</div>
{{--                        <div data-toggle="modal" data-target="#favourites_modal" class="product-card__like bb-price-tag-icon-container"><span class="material-icons">favorite</span></div>--}}


                        <div> <span class="product-card__like-icon-for-out material-icons product-card__like-icon " data-id="{{$productFromBase->id}}">favorite</span></div>


{{--                        <div style="margin-top: 2px" data-id="{{$productFromBase->id}}" class="product-card__shopping-cart shopping_cart_btn bb-price-tag-icon-container shopping_cart_btn" ><span class="material-icons">shopping_cart</span></div>--}}

                        <div><span data-id="{{$productFromBase->id}}" class="product-card__shopping-cart shopping_cart_btn material-icons ">shopping_cart</span></div>



                    </div>



{{--//в корзину--}}


                </div>
            </div>
            {{--img--}}
            <div class="col-lg-4 col-md-12 col-sm-12 p-0 p-lg-5 p-md-4 p-sm-3 mt-3">
                <div class="shadow bg-white rounded p-3  p-2"
                     style="display: flex; justify-content: center;box-sizing: border-box; width: 100%">
                    <div class="row" style="display: flex; align-items: center; padding: 0;  margin:0;">
                        <img data-toggle="modal" data-target="#exampleModalCenter" class="img-fluid"
                             src="{{asset('/storage/uploads/'.$productFromBase['img'])?? ''}}"
                             style="cursor: pointer; max-height: 400px; width: auto"
                             alt="{{$productFromBase['name'] ?? '0'}}" title="{{$productFromBase['name'] ?? '0'}}">
                    </div>
                </div>
                @if (Auth::check())
                    <div class="card-technical rounded bg-light mt-0  mt-4  p-2"
                         style="font-size: 11px; min-width: 100%">
                        <div>Менеджер: {{auth()->user()->name}}</div>
                        <div>Категория товара: {{$productFromBase->category_id}} ({{$productFromBase->slug}})</div>
                        <div>ID: {{$productFromBase->id}} / Внешний ID: {{$productFromBase->external_id}}</div>
                        <div>Дата создания: {{$productFromBase->created_at}}</div>
                        <div>Дата обновления: {{$productFromBase->updated_at}}</div>
                    </div>
                @else
                    <div class="card-technical rounded bg-light mt-4 mb-0 p-2 shadow"
                         style="font-size: 11px; min-width: 100%">

                        <div>Идентификатор товара: {{$productFromBase->id}}</div>

                    </div>
                @endif
            </div>
            {{--ROW with buttons--}}
            <div class="row p-0 ps-lg-5 ps-md-4 ps-sm-3 pe-lg-5 pe-md-4 pe-sm-3 mt-sm-1 mt-4 mb-2 mb-md-0  "
                 style="margin:0; display: flex; align-items: center; justify-content: space-between">
                {{--go back--}}
                <div class="col-lg-8 col-md-12 col-sm-12" style="display: inline-block; width: fit-content;padding: 0">
                    <nav><a class="btn btn-warning" href="{{$previous_url}}">Назад в каталог</a></nav>
                </div>
                @can(['update-product', 'delete-product'], $productFromBase)
                    {{--delete or edit--}}
                    <div class="col-lg-4 col-md-12 col-sm-12"
                         style="padding:0; display: flex; width: fit-content; height: fit-content; align-items: end; justify-content: end">
                        <a href="{{ route('products_base.edit', $productFromBase->id)}}" class="btn btn-edit"
                           style="margin-right: 0.6rem">
                            <i style="font-size: 1.3rem" class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('products_base.destroy', $productFromBase->id)}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-dell">
                                <i style="font-size: 1.5rem" class="bi bi-x-octagon"></i>
                            </button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"
                     style="border: 0; padding-left: 1.5rem; padding-right: 1.5rem; display: flex; align-items: start">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{$productFromBase['name'] ?? '0'}}</h5>
                    <div style="width: fit-content; padding: 0; margin-left: 10px ">
                        <i style="font-size: 1.4rem; cursor: pointer; " class="bi bi-x-square modal__close-btn"
                           data-dismiss="modal" aria-label="Close"></i>
                    </div>
                </div>
                <div class="modal-body" style="display: flex; align-items: center; justify-content: center">
                    <img class="img-fluid max-width: 100% height: auto"
                         src="{{asset('/storage/uploads/'.$productFromBase->img)?? '0'}}"
                         style="max-height: 400px; width: auto" alt="{{$productFromBase['name'] ?? '0'}}"
                         title="{{$productFromBase['name'] ?? '0'}}">
                </div>
                <div style="border: 0" class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('components.footer')
@endsection


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
                    "{{route('cart_icons_added')}}",
                    "{{asset('/storage/uploads')}}",
                    "{{csrf_token()}}"
                );
                cart_gl.showTotalQuantity('{{\Cart::session(\Illuminate\Support\Facades\Session::getId())->getTotalQuantity()}}')
                cart_gl.addProductToCart()
                cart_gl.removeProductFromCart()
                cart_gl.removeProductByCartByModal()

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



