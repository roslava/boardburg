@section('bb-catalog')
    <div class="bb-catalog">
        <div class="bb-catalog__container">
            <div id="bb-catalog__products">111</div>
            {{--            @if(!count($productsFromBase)==0)--}}
            {{--                @foreach($productsFromBase as $product)--}}
            {{--                    {{$product->name}}--}}
            {{--                @endforeach--}}
            {{--            @endif--}}
        </div>
    </div>
@endsection
@yield('bb-catalog')

<style>
    .bb-catalog {
        display: none;
    }

    /*@media (max-width: 991px) {*/
    /*    .bb-catalog_show {*/
    /*        display: none !important;*/
    /*    }*/
    /*}*/

    .bb-catalog_show {
        display: block;
        width: 100%;
        min-height: 60px;
        background-color: #86b7fe;
        top: 60px;
        position: fixed;
        z-index: 999;
    }

    @media (max-width: 767px) {
        .bb-catalog_show {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }

    .bb-catalog__container {
        background-color: #ab2836;
        margin: 0 auto;
        max-width: 1300px !important;
    }


    @media (max-width: 1399px) {
        .bb-catalog__container {
            max-width: 1110px !important;
        }
    }

    @media (max-width: 1199px) {
        .bb-catalog__container {
            max-width: 939px !important;
        }
    }

    @media (max-width: 991px) {
        .bb-catalog__container {
            max-width: 700px !important;
        }
    }

    @media (max-width: 767px) {
        .bb-catalog__container {
            min-width: 100%;
        }
    }
</style>

<script>
    $(document).ready(function () {
        fetchData()

        function fetchData() {
            $.ajax({
                type: 'GET',
                url: '/catalog',
                success: function (data) {
                    $(".bb-catalog__container").html(data[0].name);
                    console.log(data[0].name);
                }
            })
        }
    })
</script>
