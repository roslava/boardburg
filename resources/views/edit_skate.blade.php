
@extends('layouts.base')


@section('header')
    @include('components.header')
@endsection




@section('main')


<div class="container-md bg-light mt-5 p-4 mb-5 rounded">


{{--    breadcrumb--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('skates_base.index')}}">Каталог</a></li>
            <li class="breadcrumb-item"><a href="{{ route("skates_base.index")}}/{{$skateFromBase->id}}">{{$skateFromBase->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редактирование товара </li>
        </ol>
    </nav>




    <h1>Редактировать</h1>


    <form action="{{route('skates_base.update', $skateFromBase->id)}}" method="POST" class="rounded">

        @csrf
        @method('PUT')

        <div class="form-group mt-4">
            <label for="name">Название товара</label>
            <input type="text" name="name" value="{{ $skateFromBase->name }}" class="form-control" id="name" placeholder="Название товара">

        </div>

        <div class="form-group mt-4">
            <label for="description">Описание товара</label>
            <textarea name="description" class="form-control" id="description" rows="3">{{ $skateFromBase->description }}</textarea>
        </div>

        <div class="form-group mt-4">
            <label for="img">Адрес изображения</label>
            <input type="text" name="img" value="{{ $skateFromBase->img }}" class="form-control" id="img" placeholder="URL">
        </div>

        <div class="form-group mt-4">
            <label for="price">Цена</label>
            <input type="text" name="price" value="{{ $skateFromBase->price }}" class="form-control" id="price" placeholder="Цена">
        </div>

        <div class="form-group mt-4">
            <label for="text">Категория товара</label>
            <input type="text" name="category_id" value="{{ $skateFromBase->category_id }}"  class="form-control" id="text" placeholder="Номер категории товара">
        </div>

        <button class="btn btn-primary mt-4" style="margin-right: 1rem !important;"  type="submit">Сохранить</button>

        <a href="{{ route('skates_base.index')}}" class="btn btn-info mt-4" >Отменить</a>
    </form>



</div>

@endsection

@section('footer')
    @include('components.footer')
@endsection
