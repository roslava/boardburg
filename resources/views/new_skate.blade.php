
@extends('layouts.base')


@section('header')
    <div class="header-bg container-fluid  p-0 m-0" style="background-color: #0a53be;display: flex;">

        <div class="row  p-0 m-0 " style="min-width: 100%">
            <img class="  p-0 m-0" src="http://boardburg.xx/img/fence.png"
                 style="min-width: 100%; display: flex; align-self: end " alt="alt text">
        </div>
    </div>
@endsection




@section('main')


<div class="container-md bg-light mt-3 p-4">


{{--breadcrumb--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('skates_base.index')}}">Каталог</a></li>
            <li class="breadcrumb-item active" aria-current="page">Создание нового товара</li>
        </ol>
    </nav>



    <h1>Создание нового товара</h1>


    <form action="{{route('skates_form.store')}}">

        @csrf
        @method("POST")

        <div class="form-group mt-4">
            <label for="name">Название товара</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Название товара">
        </div>

        <div class="form-group mt-4">
            <label for="description">Описание товара</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
        </div>

        <div class="form-group mt-4">
            <label for="img">Адрес изображения</label>
            <input type="text" name="img" class="form-control" id="img" placeholder="URL">
        </div>

        <div class="form-group mt-4">
            <label for="price">Цена</label>
            <input type="text" name="price" class="form-control" id="price" placeholder="Цена">
        </div>

        <div class="form-group mt-4">
            <label for="text">Категория товара</label>
            <input type="text" name="category_id" class="form-control" id="text" placeholder="Номер категории товара">
        </div>

        <button class="btn btn-primary mt-4" style="margin-right: 1rem !important;"  type="submit">Создать</button>

        <a href="{{ route('skates_base.index')}}" class="btn btn-info mt-4" >Отменить</a>




    </form>




























</div>

@endsection

@section('footer')
    <div class="container-md bg-light">Футер</div>
@endsection
