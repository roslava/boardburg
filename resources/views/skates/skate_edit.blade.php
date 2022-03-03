@extends('layouts.base')
@section('header')
    @include('components.header')
@endsection

@section('main')
    <div class="container-md bg-light mt-5 p-4 mb-5 rounded">
        {{--    breadcrumb--}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="color: rgb(30,152,95);" href="{{ route('skates_base.index')}}">Каталог</a></li>
                <li class="breadcrumb-item"><a style="color: rgb(30,152,95);"
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

{{--            <input type="file" value="{{$article->article_cover}}"--}}

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
 {{--source: "http://boardburg.xx/storage/uploads/"+"{{$skateFromBase->img}}"--}}
 source: "http://"+"{{request()->getHttpHost()}}"+"/storage/uploads/"+"{{$skateFromBase->img}}"
            }]
        });
    </script>
@endsection

$host = request()->getHttpHost(); // returns dev.site.com
