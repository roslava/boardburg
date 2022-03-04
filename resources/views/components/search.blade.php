@section('search')
    <div class="col-md-12 mb-4">
        <form class="form-inline b0 col-md-12 d-flex justify-content-center" method="GET"
              action="{{route('search.index')}}">
            <div class="col-xl-6 col-lg-8 col-md-6 col-8 pe-xl-3 pe-lg-2 pe-md-3 pe-sm-3">
                <input type="text" class="live-input border-0 ms-xl-2 ms-lg-0 mr-sm-2 rounded col-12 p-2"
                       id="search_input_bb" name="search_input_bb" placeholder="Поиск среди товаров"
                       value="{{request()->search_input_bb}}"
                >
            </div>
            <button type="submit" class="btn btn-primary" id="search_input_button">Найти</button>
        </form>
    </div>
    <script src="{{mix('/js/button_disabled.js')}}" defer></script>
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
