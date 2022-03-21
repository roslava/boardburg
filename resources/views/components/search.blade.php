@section('search')
    <div class="bb-search__container" id="bb-search__container">
        <div class="bb-search__wrapper">
            <i class="bi bi-x-circle bb-search__close-icon" id="bb-search__close-icon">
            </i>
            <form class="bb-search__form" method="GET"
                  action="{{route('search.index')}}">

                <input type="text" class="live-input bb-search__input"
                       id="search_input_bb" name="search_input_bb" placeholder="Круто! Что ищем?"
                       value="{{request()->search_input_bb}}">
                <button type="submit" class="bb-search__button" id="search_input_button">Найти</button>
            </form>
        </div>
    </div>
    <div class="bb-nav-mob__search bb-nav-mob__round-icon bb-search-btn-icon" id="bb-search-btn-icon">
        <i class="bi bi-search"></i>
    </div>
@endsection
@yield('search')
