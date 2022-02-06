@section('product_card')


    @foreach($skatesFromBase as $skateFromBase)
        {{--@can('view',$skateFromBase)--}}
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card" style="height: 100%">
                <div class="row pt-3" style="justify-content: center;margin:0">
                    <img src="{{$skateFromBase->img}}" class="card-img-top"
                         style="max-height: 200px; width: fit-content;" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$skateFromBase->name}}</h5>
                    <p class="card-text">{{ substr($skateFromBase->description, 0, strpos(wordwrap($skateFromBase->description, 100), "\n")).'...'}}</p>
                    <div style=" display: flex; justify-content: space-between; align-items: center">
                        <form action="{{ route('skates_base.show', $skateFromBase->id)}}">
                            <button class="btn btn-primary">Подробнее</button>
                        </form>

                        <span class="badge rounded-pill bg-warning text-dark pt-2"
                              style="font-size: 13px; font-weight: bold">{{$skateFromBase->price}} руб.</span>
                    </div>
                </div>
                <div class="card_bottom m-3" style="display: flex; flex-direction: column; align-items: end">
                    @if (Auth::check())
                        <div class="card-technical rounded bg-light mt-0 mb-4 p-2 shadow"
                             style="font-size: 11px; min-width: 100%">
                            <div>Опубликовал менеджер: {{$skateFromBase->user_id}}</div>
                            <div>Категория: {{$skateFromBase->category_id}}</div>
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
                    <div class="row" style="margin-right: 0.1rem">
                        @can(['update-skate', 'delete-skate'], $skateFromBase)
                            <a href="{{ route('skates_base.edit', $skateFromBase->id)}}" class="btn btn-edit"
                               style="margin-right: 0.6rem">
                                @include('components.button_edit_svg')
                            </a>
                            <form class="p-0 m-0" style="display: inline; max-width: 30px"
                                  action="{{ route('skates_base.destroy', $skateFromBase->id)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-dell">
                                    @include('components.button_delete_svg')
                                </button>
                            </form>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
        {{--@endcan--}}
    @endforeach
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
