@extends('layouts.base')

@section('header')
    @include('components.header')
@endsection

@section('main')
    <div class="container-md bg-light mt-3">
        <div class="row">
            {{--Информация--}}
            <div class="col-lg-8 col-md-12 col-sm-12 p-0">
                <div class=" m-lg-5 m-md-4  m-sm-3">
                    {{--breadcrumb  --}}
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('skates_base.index')}}">Каталог</a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page">{{$skateFromBase['name'] ?? '0'}}</li>
                        </ol>
                    </nav>
                    <h1 class="mt-4">{{$skateFromBase['name'] ?? '0'}}</h1>
                    <p>{{$skateFromBase['description'] ?? '0'}}</p>
                    <h4>Цена: {{$skateFromBase['price'] ?? '0'}} руб.</h4>
                </div>
            </div>
            {{--Изображение--}}
            <div class="col-lg-4 col-md-12 col-sm-12 p-0 p-lg-5 p-md-4 p-sm-3">
                <div class="shadow bg-white rounded p-3  p-2"
                     style="display: flex; justify-content: center;box-sizing: border-box; width: 100%">
                    <div class="row" style="display: flex; align-items: center; padding: 0;  margin:0;">
                        <img class="img-fluid max-width: 100% height: auto" src="http://boardburg.xx/storage/{{$skateFromBase['img'] ?? '0'}}"
                             style="max-height: 400px;" alt="">
                    </div>
                </div>
                <div class="card-technical rounded bg-light mt-4 mb-4 p-2 shadow"
                     style="font-size: 11px; min-width: 100%">
                    <div>Категория: {{$skateFromBase->category_id}}</div>
                    <div>ID: {{$skateFromBase->id}} / Внешний ID: {{$skateFromBase['external_id'] ?? 'нет'}}</div>
                    <div>Дата создания: {{$skateFromBase->created_at}}</div>
                    <div>Дата обновления: {{$skateFromBase->updated_at}}</div>
                </div>
            </div>
        </div>
        {{--ROW c кнопками--}}
        <div class="row">
            {{--Назад в каталог--}}
            <div class="col-lg-8 col-md-12 col-sm-12 p-lg-5 p-md-4 p-sm-3" style="padding-top: 0!important;">
                <nav><a class="btn btn-warning" href="{{$previous_url}}">Назад в каталог</a></nav>
            </div>
            @can(['update-skate', 'delete-skate'], $skateFromBase)
                {{--Удалить и редактировать--}}
                <div class="col-lg-4 col-md-12 col-sm-12 p-lg-5 p-md-4 p-sm-3"
                     style="padding-top: 0!important; display: flex; align-items: end; justify-content: end">
                    <a href="{{ route('skates_base.edit', $skateFromBase->id)}}" class="btn btn-edit"
                       style="margin-right: 0.6rem">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd"
                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <form action="{{ route('skates_base.destroy', $skateFromBase->id)}}" method="post">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-dell">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                 class="bi bi-x-octagon" viewBox="0 0 16 16">
                                <path
                                    d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
@endsection
@section('footer')
    @include('components.footer')
@endsection
