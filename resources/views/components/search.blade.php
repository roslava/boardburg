@section('search')

    <form class="bb-search__form" method="GET"
          action="{{route('search.index')}}">

        <input type="text" class="live-input bb-search__input"
               id="search_input_bb" name="search_input_bb" placeholder="Что ищем?"
               value="{{request()->search_input_bb}}">
        <button type="submit" class="btn bb-search__button" id="search_input_button">Найти</button>
    </form>
@endsection
@yield('search')

<script>
    let search_input = document.getElementById('search_input_bb');
    let search_input_button = document.getElementById('search_input_button');
    window.onload = function () {
        if (search_input.value.length == 0)
            search_input_button.disabled = true
    };
    search_input.addEventListener('input', updateValue);

    function updateValue(e) {
        function сheckSpaces(str) {
            return str.trim() !== '';
        }
        if (!сheckSpaces(e.target.value)) {
            search_input_button.disabled = true
        } else {
            search_input_button.disabled = false
            // search_input.value = 0
        }
    }
</script>
