@extends('layouts.base')

@section('header')
    @include('components.header')
@endsection

@section('main')
    <div class="container-md bg-light rounded">
        <div class="row p-3 pb-3 pb-lg-5 pb-md-4 pb-sm-3   mb-0 mt-0  mt-lg-4 mb-lg-4 mt-md-3 mb-md-3  ">
            {{--Информация--}}
            <div class="col-lg-8 col-md-12 col-sm-12 p-0">
                <div class=" m-lg-5 m-md-4  m-sm-3">
                    {{--breadcrumb  --}}
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a style="color: rgb(30,152,95);"
                                                           href="{{ route('skates_base.index')}}">Каталог</a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page">{{$skateFromBase['name'] ?? '0'}}</li>
                        </ol>
                    </nav>
                    <h1 class="mt-4 bb-product-title">{{$skateFromBase['name'] ?? '0'}}</h1>
                    <p>{{$skateFromBase['description'] ?? '0'}}</p>
                    <h4 style="color: rgb(30,152,95)"> {{$skateFromBase['price'] ?? '0'}} руб.</h4>
                </div>
            </div>
            {{--Изображение--}}

            <div class="col-lg-4 col-md-12 col-sm-12 p-0 p-lg-5 p-md-4 p-sm-3 mt-3">
                <div class="shadow bg-white rounded p-3  p-2"
                     style="display: flex; justify-content: center;box-sizing: border-box; width: 100%">
                    <div class="row" style="display: flex; align-items: center; padding: 0;  margin:0;">
                        <img data-toggle="modal" data-target="#exampleModalCenter" class="img-fluid"
                             src="{{asset('/storage/uploads/'.$skateFromBase->img)?? '0'}}"

                             style="cursor: pointer; max-height: 400px; width: auto"
                             alt="{{$skateFromBase['name'] ?? '0'}}" title="{{$skateFromBase['name'] ?? '0'}}">
                    </div>
                </div>


                @if (Auth::check())
                    <div class="card-technical rounded bg-light mt-0  mt-4  p-2"
                         style="font-size: 11px; min-width: 100%">
                        <div>Менеджер: {{auth()->user()->name}}</div>
                        <div>Категория товара: {{$skateFromBase->category_id}} ({{$skateFromBase->slug}})</div>
                        <div>ID: {{$skateFromBase->id}} / Внешний ID: {{$skateFromBase->external_id}}</div>
                        <div>Дата создания: {{$skateFromBase->created_at}}</div>
                        <div>Дата обновления: {{$skateFromBase->updated_at}}</div>
                    </div>
                @else
                    <div class="card-technical rounded bg-light mt-4 mb-0 p-2 shadow"
                         style="font-size: 11px; min-width: 100%">

                        <div>Идентификатор товара: {{$skateFromBase->id}}</div>

                    </div>
                @endif
            </div>


            {{--ROW c кнопками--}}
            <div class="row p-0 ps-lg-5 ps-md-4 ps-sm-3 pe-lg-5 pe-md-4 pe-sm-3 mt-sm-1 mt-4 mb-2 mb-md-0  "
                 style="margin:0; display: flex; align-items: center; justify-content: space-between">
                {{--Назад в каталог--}}
                <div class="col-lg-8 col-md-12 col-sm-12" style="display: inline-block; width: fit-content;padding: 0">
                    <nav><a class="btn btn-warning" href="{{$previous_url}}">Назад в каталог</a></nav>
                </div>
                @can(['update-skate', 'delete-skate'], $skateFromBase)
                    {{--Удалить и редактировать--}}
                    <div class="col-lg-4 col-md-12 col-sm-12"
                         style="padding:0; display: flex; width: fit-content; height: fit-content; align-items: end; justify-content: end">
                        <a href="{{ route('skates_base.edit', $skateFromBase->id)}}" class="btn btn-edit"
                           style="margin-right: 0.6rem">

                            <i style="font-size: 1.3rem" class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('skates_base.destroy', $skateFromBase->id)}}" method="post">
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





















    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"
                     style="border: 0; padding-left: 1.5rem; padding-right: 1.5rem; display: flex; align-items: start">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{$skateFromBase['name'] ?? '0'}}</h5>
                    <div style="width: fit-content; padding: 0; margin-left: 10px ">
                        <i style="font-size: 1.4rem; cursor: pointer; " class="bi bi-x-square modal__close-btn"
                           data-dismiss="modal" aria-label="Close"></i>
                    </div>
                </div>
                <div class="modal-body" style="display: flex; align-items: center; justify-content: center">
                    <img class="img-fluid max-width: 100% height: auto"
                         src="{{asset('/storage/uploads/'.$skateFromBase->img)?? '0'}}"
                         style="max-height: 400px; width: auto" alt="{{$skateFromBase['name'] ?? '0'}}"
                         title="{{$skateFromBase['name'] ?? '0'}}">
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
