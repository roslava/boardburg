@extends('layouts.base')
@section('main')
    <div class="container-md bg-light mt-5 p-4 mb-5 rounded">
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
                <label class="mb-1" for="name">Название товара</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                @error('name')
                <span
                    class="invalid-feedback"
                    role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mt-4">
                <label class="mb-1" for="description">Описание товара</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{old('description') }}</textarea>
                @error('description')
                <span
                    class="invalid-feedback"
                    role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mt-4">
                <label class="mb-1" for="img">Адрес изображения</label>
                <input type="text" name="img" class="form-control @error('img') is-invalid @enderror" id="img">
            </div>
            <div class="form-group mt-4">
                <label class="mb-1" for="price">Цена</label>
                <input type="text" name="price" maxlength="6" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price') }}">
                @error('price')
                <span
                    class="invalid-feedback"
                    role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-4">
            <label class="mb-1" for="">Категория товара</label>
            <div class="bb-inputs-grupper input-group ">


{{--                <div class="bb-form-check" style="margin-left: 0">--}}
{{--                    <input class="form-check-input" type="radio" name="category_id"--}}
{{--                           id="checkCategory1" value='1'>--}}
{{--                    <label class="form-check-label" for='checkCategory1'>--}}
{{--                        Доски--}}
{{--                    </label>--}}

{{--                </div>--}}

{{--                <div class=" bb-form-check"style="margin-left: 0">--}}
{{--                    <input class="form-check-input " type="radio" name="category_id"--}}
{{--                           id="checkCategory2" value='2'>--}}
{{--                    <label class="form-check-label" for='checkCategory2'>--}}
{{--                        Подвески--}}
{{--                    </label>--}}
{{--                </div>--}}

{{--                <div class="bb-form-check"style="margin-left: 0">--}}
{{--                    <input class="form-check-input " type="radio" name="category_id"--}}
{{--                           id="checkCategory3" value='3'>--}}
{{--                    <label class="form-check-label" for='checkCategory3'>--}}
{{--                        Колеса--}}
{{--                    </label>--}}
{{--                </div>--}}

{{--                <div class="bb-form-check"style="margin-left: 0">--}}
{{--                    <input class="form-check-input @error('category_id') is-invalid @enderror" type="radio" name="category_id"--}}
{{--                           id="checkCategory4" value='4'>--}}
{{--                    <label class="form-check-label" for='checkCategory4'>--}}
{{--                        Подшипники--}}
{{--                    </label>--}}

{{--                    @error('category_id')--}}
{{--                    <span style="display: inline; margin-left: 1.5rem"--}}
{{--                        class="invalid-feedback"--}}
{{--                        role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}

{{--                </div>--}}







            @foreach($products=[['Доски'],['Подвески'],['Колеса'],['Подшипники']] as $key => $product)
                      <div class="bb-form-check">
                        <input class="form-check-input @if($key == 3)@error('category_id') is-invalid  @enderror @endif" type="radio" name="category_id"
                               id={{"checkCategory".$key++}} value={{$key}}>
                        <label class="form-check-label" for={{"checkCategory".$key}}>
                            {{$product[0]}}
                            {{$key}}
                        </label>
                          @if($key == count($products))
                          @error('category_id')
                          <div style="display: flex; "
                                class="invalid-feedback"
                                role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                          @enderror
                          @endif
                    </div>
                              @endforeach






            </div>
            </div>

            <button class="btn btn-primary mt-4" style="margin-right: 1rem !important;" type="submit">Создать</button>
            <a href="{{ route('skates_base.index')}}" class="btn btn-info mt-4">Отменить</a>
        </form>
    </div>
@endsection
@section('footer')
    @include('components.footer')
@endsection