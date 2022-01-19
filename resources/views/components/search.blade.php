@section('search')
    <div class="col-md-12 mb-4">
    <form class="form-inline b0 col-md-12 d-flex" method="GET" action="{{route('search.index')}}">



        <div class="offset-xl-3 offset-lg-0 col-xl-6 col-lg-8 col-md-6 col-8 pe-xl-3 pe-lg-2 pe-md-3 pe-sm-3">
        <input type="text" class="live-input border-0 ms-xl-2 ms-lg-0 mr-sm-2 rounded col-12 p-2" id="search_input" name="search_input" placeholder="Поиск среди товаров" value="{{request()->search_input}}" >
        </div>
        <button type="submit" class="btn btn-primary" id="search_input_button">Найти</button>




    </form>
    </div>
@endsection
@yield('search')
