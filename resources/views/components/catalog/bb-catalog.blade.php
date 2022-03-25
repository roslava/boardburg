@section('bb-catalog')
    <div class="bb-catalog">
        <div class="bb-catalog__container">
            <div id="catalog-categories">
                <ul class="categories-list">
                </ul>
            </div>
            <div id="itemsInCategory">
                <ul>

                </ul>
            </div>

        </div>
    </div>
@endsection
@yield('bb-catalog')

<style>
    .bb-catalog {
        display: none;
    }


    .catalog-categories{

    }

    .bb-catalog_show {
        padding-top: 30px;
        padding-bottom: 20px;
        display: block;
        width: 100%;
        min-height: 60px;
        background: rgba(33, 37, 41, 0.98) !important;
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
        /*background-color: #ab2836;*/
        margin: 0 auto;
        max-width: 1300px !important;
        display: flex;
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

    .categories-list{
        display: flex;
        flex-direction: column;
        list-style-type: none !important;
        line-height: 30px !important;
        margin-left: 0px !important;
        justify-content: stretch;
        min-width: 100%;
    }

    .categories-list-item{
        list-style-type: none;
        border-bottom: 1px dotted rgb(17, 26, 23);
        margin-left: 0px !important;
        display: flex;
        justify-content: stretch;
        min-width: 100%;

    }
    .categories-list-item > a{
        text-decoration: none !important;
        color: #a4a3a3 !important;
        margin-left: 0px !important;
        min-width: 100%;
        justify-content: stretch;
        padding-left: 10px;
        padding-right: 10px;
    }

    .categories-list-item > a:hover{
        color: #ffffff !important;
        background-color: rgba(31, 56, 44, 0.71);
    }

    .products-list-item{
        list-style-type: none;
        line-height: 30px !important;
    }

    .products-list-item > a{
        text-decoration: none !important;
        color: #a4a3a3 !important;
    }

    .products-list-item > a:hover{
        color: #ffffff !important;
    }

</style>

<script>
    $(document).ready(function () {
            fetchCategories()

            function fetchCategories() {
                $.ajax({
                    type: 'GET',
                    url: '/catalog',
                    success: function (data) {
                        $result = ''
                        $.each(data['cat'], function (index, value) {
                            $("#catalog-categories ul").html($result += `<li data-cat_=${value.category_name_en} class="categories-list-item"> <a href="#">` + value.category_name_ru + '</a> </li>')
                        });
                        document.querySelectorAll('.categories-list-item').forEach((item) => {
                            item.addEventListener('mouseenter', function () {
                                fetchCategoryItems(item.dataset.cat_)
                            })
                        })
                    }
                })
            }


            function fetchCategoryItems(cat) {
                $.ajax({
                    type: 'GET',
                    url: `/catalog/${cat}`,
                    success: function (data) {
                        $result = ''
                        $.each(data['products'], function (index, value) {
                            $("#itemsInCategory ul").html($result += '<li class="products-list-item"><a href="/products/' + value.id + '">' + value.name + '</a></li>')
                        });
                    }
                })
            }
        }
    )
</script>
