@section('product_card')


    @if(!count($skatesFromBase)==0)
    @foreach($skatesFromBase as $skateFromBase)
        {{--@can('view',$skateFromBase)--}}

        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card" style="height: 100%">
                <div class="row pt-3" style="justify-content: center; margin:0">
                    <a style="width: 100%; display: flex; justify-content: center; " href="{{ route('skates_base.show', $skateFromBase->id)}}"><img src="{{asset('/storage/uploads/'.$skateFromBase->img)}}" class="card-img-top"
                         style="max-height: 200px; width: auto;" alt="{{$skateFromBase->name}}" title="{{$skateFromBase->name}}"></a>
                </div>
                <div class="card-body">
                    <h5 class="bb-card-title">{{$skateFromBase->name}}</h5>
                    <p class="card-text">{{ substr($skateFromBase->description, 0, strpos(wordwrap($skateFromBase->description, 100), "\n")).'...'}}</p>
                    <div style=" display: flex; justify-content: space-between; align-items: center">
                        <form action="{{ route('skates_base.show', $skateFromBase->id)}}">
                            <button class="btn product-card__detailes">Подробнее</button>
                        </form>

{{--                        <span class="badge rounded-pill bg-warning text-dark pt-2 pb-2"--}}
                        <div class="bb-product-card-price"
                              >{{$skateFromBase->price}} <span class="rub">c</span></div>
                    </div>
                </div>
                <div class="card_bottom m-3" style="display: flex; flex-direction: column; align-items: end">
                    @if (Auth::check())
                        <div class="card-technical rounded bg-light mt-0 mb-4 p-2 shadow"
                             style="font-size: 11px; min-width: 100%">
                            <div>Менеджер: {{auth()->user()->name}}</div>
                            <div>Категория товара: {{$skateFromBase->category_id}} ({{$skateFromBase->slug}})</div>
                            <div>ID: {{$skateFromBase->id}} / Внешний ID: {{$skateFromBase->external_id}}</div>
                            <div>Дата создания: {{$skateFromBase->created_at}}</div>
                            <div>Дата обновления: {{$skateFromBase->updated_at}}</div>
                        </div>
                    @else
                        <div class="card-technical rounded bg-light mt-0 mb-0 p-2 shadow"
                             style="font-size: 11px; min-width: 100%">

                            <div>ID: {{$skateFromBase->id}}</div>

                        </div>
                    @endif
                    <div class="row product-card__btn-holder">
                        @can(['update-skate', 'delete-skate'], $skateFromBase)
                            <a href="{{ route('skates_base.edit', $skateFromBase->id)}}" class=" btn btn-edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form class="p-0 m-0 float-end " style="display: inline; max-width: 30px"
                                  action="{{ route('skates_base.destroy', $skateFromBase->id)}}" method="post">
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
        {{--@endcan--}}
    @endforeach
    @endif
    @if(count($skatesFromBase)==0)
        <div class="d-flex" style="font-size: 16px">
            <p class="light" style="color: #198754"><i style="color: #2BE891" class="bi bi-emoji-frown"></i> По запросу
                <span style="font-weight: bold !important; color: #2BE891">{{ $search ?? '' }}</span> не найдено ни
                одного товара.&nbsp;</p>
            <a href="{{route('skates_base.index')}}">Вернуться ко всем товарам.</a>
        </div>
    @endif

@endsection


@yield('product_card')

