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
                <li class="breadcrumb-item"><a
                        href="{{ route("skates_base.index")}}/{{$skateFromBase->id}}">{{$skateFromBase->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Редактирование товара</li>
            </ol>
        </nav>
        <h1>Редактировать</h1>


        <form action="{{route('skates_base.update', $skateFromBase->id)}}" enctype="multipart/form-data"  method="POST" >

            @csrf
            @method("PUT")
            <div class="form-group mt-4">
                <label class="mb-1" for="name">Название товара</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                       value="{{ $skateFromBase->name }}">
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
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                          id="description" rows="3">{{ $skateFromBase->description }}</textarea>
                @error('description')
                <span
                    class="invalid-feedback"
                    role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mt-4">
                <label class="mb-1" for="price">Цена</label>
                <input type="text" name="price" maxlength="6" class="form-control @error('price') is-invalid @enderror"
                       id="price" value="{{ $skateFromBase->price }}">
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

                    @foreach($products=[['Доски'],['Подвески'],['Колеса'],['Подшипники']] as $key => $product)
                        <div class="bb-form-check">
                            <input
                                class="form-check-input @if($key == 3)@error('category_id') is-invalid  @enderror @endif"
                                type="radio" name="category_id"
                                id={{"checkCategory".$key++}}   value="{{ $skateFromBase->category_id}}" @if($skateFromBase->category_id == $key) checked @endif>
                            <label class="form-check-label" for={{"checkCategory".$key}}>
                                {{$product[0]}}
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

            <label class="mb-1" for="image">Загрузка изображения товара</label>
            <div class="bb-inputs-grupper input-group ">
                <input type="file" name="image" title=" ууу" id="image" class="@error('image') is-invalid @enderror">

                @error('image')
                <span
                    class="invalid-feedback"
                    role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <input type="file" name="ttest" id="ttest">


            <button class="btn btn-primary mt-4" style="margin-right: 1rem !important;" type="submit">Сохранить</button>
            <a href="{{ route('skates_base.index')}}" class="btn btn-info mt-4">Отменить</a>
        </form>





















{{--        <form action="{{route('skates_base.update', $skateFromBase->id)}}" method="POST" class="rounded">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}

{{--            <div class="form-group mt-4">--}}
{{--                <label for="name">Название товара</label>--}}
{{--                <input type="text" name="name" value="{{ $skateFromBase->name }}" class="form-control" id="name"--}}
{{--                       placeholder="Название товара">--}}
{{--            </div>--}}
{{--            <div class="form-group mt-4">--}}
{{--                <label for="description">Описание товара</label>--}}
{{--                <textarea name="description" class="form-control" id="description"--}}
{{--                          rows="3">{{ $skateFromBase->description }}</textarea>--}}
{{--            </div>--}}
{{--            <div class="form-group mt-4">--}}
{{--                <label for="img">Адрес изображения</label>--}}
{{--                <input type="text" name="img" value="{{ $skateFromBase->img }}" class="form-control" id="img"--}}
{{--                       placeholder="URL">--}}
{{--            </div>--}}
{{--            <div class="form-group mt-4">--}}
{{--                <label for="price">Цена</label>--}}
{{--                <input type="text" name="price" value="{{ $skateFromBase->price }}" class="form-control" id="price"--}}
{{--                       placeholder="Цена">--}}
{{--            </div>--}}
{{--            <div class="form-group mt-4">--}}
{{--                <label for="text">Категория товара</label>--}}
{{--                <input type="text" name="category_id" value="{{ $skateFromBase->category_id }}" class="form-control"--}}
{{--                       id="text" placeholder="Номер категории товара">--}}
{{--            </div>--}}
{{--            <button class="btn btn-primary mt-4" style="margin-right: 1rem !important;" type="submit">Сохранить</button>--}}
{{--            <a href="{{ route('skates_base.index')}}" class="btn btn-info mt-4">Отменить</a>--}}
{{--        </form>--}}
    </div>








@endsection
@section('footer')
    @include('components.footer')
@endsection


@section('scripts')
    <script>
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[id="ttest"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);

        // FilePond.setOptions({
        //     server:'uploads'
        // })

    </script>
@endsection
