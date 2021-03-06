@extends('layouts.base')
@section('header')
    @include('components.header')
@endsection

@section('main')
    <div class="container-md bg-light mt-5 p-4 mb-5 rounded" style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;">
        {{--    breadcrumb--}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="color: rgb(30,152,95);" href="{{ route('products_base.index')}}">Каталог</a></li>
                <li class="breadcrumb-item"><a style="color: rgb(30,152,95);"
                        href="{{ route("products_base.index")}}/{{$product->id}}">{{$product->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Редактирование товара</li>
            </ol>
        </nav>
        <h1>Редактировать</h1>
        <form action="{{route('products_base.update', $product->id)}}" enctype="multipart/form-data"  method="POST" >
            @csrf
            @method("PUT")
            <div class="form-group mt-4">
                <label class="mb-1" for="name">Название товара</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                       value="{{ $product->name }}">
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
                          id="description" rows="3">{{ $product->description }}</textarea>
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
                <input type="number" min="1" name="price" maxlength="6" class="form-control @error('price') is-invalid @enderror"
                       id="price" value="{{ $product->price }}">
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

                    @foreach($items=[['Доски'],['Подвески'],['Колеса'],['Подшипники']] as $key => $item)
                        <div class="bb-form-check">
                            <input
                                class="form-check-input @if($key == 3)@error('category_id') is-invalid  @enderror @endif"
                                type="radio" name="category_id"
                                id={{"checkCategory".$key++}}   value="{{ $product->category_id}}" @if($product->category_id == $key) checked @endif>
                            <label class="form-check-label" for={{"checkCategory".$key}}>
                                {{$item[0]}}
                            </label>
                            @if($key == count($items))
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
            <input type="file" id="cover" name="cover"  class="@error('cover') is-invalid @enderror">
            @error('cover')
            <span
                class="invalid-feedback"
                role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
            @enderror
            <button class="btn btn-primary mt-4" style="margin-right: 1rem !important;" type="submit">Сохранить</button>
            <a href="{{ \URL::previous() }}" class="btn btn-info mt-4">Отменить</a>
        </form>
    </div>
@endsection
@section('footer')
    @include('components.footer')
@endsection
@section('fp_scripts')
    <script>
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        const inputElement = document.querySelector('input[id="cover"]');
        const pond = FilePond.create(inputElement, {
            allowFileTypeValidation:true,
            acceptedFileTypes: ["image/jpg", "image/jpeg", "image/png"],
            maxFiles: 1,
            labelFileTypeNotAllowed:'File of invalid type',
            fileValidateTypeLabelExpectedTypes: 'Expects {allButLastType} or {lastType}',
        });
        FilePond.setOptions({
            server: {
                headers:{
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                process:{
                    url:'{{route('upload_file.store')}}'
                },
                revert: {
                    url: '{{ route('revert_tmp_file.revert')}}',
                }
            },
            files: [{
 source: "http://"+"{{request()->getHttpHost()}}"+"/storage/uploads/"+"{{$product->img}}"
            }]
        });
    </script>
@endsection
