@section('product_card')
    @if(!count($productsFromBase)==0)
        @foreach($productsFromBase as $productFromBase)
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4" style="display: flex; flex-direction: column;">
                <div class="card" style="height: 100%; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <div class="row pt-3" style="justify-content: center; margin:0">
                        @if($productFromBase->img)
                            <a style="width: 100%; display: flex; justify-content: center; "
                               href="{{ route('products_base.show', $productFromBase->id)}}"><img
                                    src="{{asset('/storage/uploads/'.$productFromBase->img)}}" class="card-img-top"
                                    style="max-height: 200px; width: auto;" alt="{{$productFromBase->name}}"
                                    title="{{$productFromBase->name}}"></a>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="bb-card-title" >{{$productFromBase->name}}</h5>
                        <p class="card-text">{{ substr($productFromBase->description, 0, strpos(wordwrap($productFromBase->description, 100), "\n")).'...'}}</p>
                        <div style=" display: flex; justify-content: space-between; align-items: center">
                            <div style="display: flex; align-items: center">
                            <form action="{{ route('products_base.show', $productFromBase->id)}}">
                                <button class="btn product-card__detailes">
                                     <span class="material-icons">visibility</span>
                                 </button>
{{--                                shopping cart add button--}}
                            </form>
                                <div> <span class="product-card__like-icon-for-out material-icons product-card__like-icon " data-id="{{$productFromBase->id}}">favorite</span></div>

                               <div><span data-id="{{$productFromBase->id}}" class="product-card__shopping-cart shopping_cart_btn material-icons ">shopping_cart</span></div>



                           </div>
                            <div class="bb-product-card-price">{{$productFromBase->price}} <span class="rub">c</span>
                            </div>
                        </div>
                    </div>
                    <div class="card_bottom m-3" style="display: flex; flex-direction: column; align-items: end">
                        @if (Auth::check())
                            <div class="card-technical rounded bg-light mt-0 mb-4 p-2 shadow"
                                 style="font-size: 11px; min-width: 100%">
                                <div>????????????????: {{$productFromBase->user_id}}</div>
                                <div>?????????????????? ????????????: {{$productFromBase->category_id}} ({{$productFromBase->slug}})
                                </div>
                                <div>ID: {{$productFromBase->id}} / ?????????????? ID: {{$productFromBase->external_id}}</div>
                                <div>???????? ????????????????: {{$productFromBase->created_at}}</div>
                                <div>???????? ????????????????????: {{$productFromBase->updated_at}}</div>
                            </div>
                        @else
                            <div class="card-technical rounded bg-light mt-0 mb-0 p-2 shadow"
                                 style="font-size: 11px; min-width: 100%">
                                <div>ID: {{$productFromBase->id}}</div>
                            </div>
                        @endif
                        <div class="row product-card__btn-holder">
                            @can(['update-product', 'delete-product'], $productFromBase)
                                <a href="{{ route('products_base.edit', $productFromBase->id)}}" class=" btn btn-edit">
                                    <i class="bi bi-pencil-square" style="margin-top: 5px"></i>
                                </a>
                                <form class="p-0 m-0 float-end " style="display: inline; max-width: 30px"
                                      action="{{ route('products_base.destroy', $productFromBase->id)}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-dell">
                                        <i style="font-size: 1.5rem;" class="bi bi-x-octagon"></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    @endif
    @if(count($productsFromBase)==0)
        <div class="d-flex" style="font-size: 16px">
            <p class="light" style="color: #198754"><i style="color: #2BE891" class="bi bi-emoji-frown"></i> ???? ??????????????
                <span style="font-weight: bold !important; color: #2BE891">{{ $search ?? '' }}</span> ???? ?????????????? ????
                ???????????? ????????????.&nbsp;</p>
            <a href="{{route('products_base.index')}}">?????????????????? ???? ???????? ??????????????.</a>
        </div>
    @endif

@endsection
@yield('product_card')




