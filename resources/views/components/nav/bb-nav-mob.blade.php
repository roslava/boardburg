@section('bb-nav-mob')

    <div class="bb-nav-mob" style="position: fixed; z-index: 2000">
        <div class="bb-nav-mob__header">
            <div class="bb-nav-mob__header-item">
                {{-- container-item 1--}}
                <div class="bb-nav-mob__logo">
                    <img src="{{ asset('img/boardburg_logo_w.svg') }}" alt="">
                </div>
                @include('components.catalog.bb-catalog-btn')
            </div>

            <div class="bb-nav-mob__header-item">
                {{--container-item 2--}}

                <div class="bb-nav-mob__burger bb-nav-mob__round-icon" id="bb-nav-mob__burger">
                    <i class="bi bi-list"></i>
                </div>
                <div class="bb-nav-mob__close bb-nav-mob__round-icon" id="bb-nav-mob__close">
                    <i class="bi bi-x-lg"></i>
                </div>
            </div>
        </div>
        <div class="bb-nav-mob__mob-search">
            @include('components.search')
        </div>
        <div class="bb-nav-mob__footer">
            <div class="bb-nav-mob__footer-item">
                {{--container-item 1--}}
            </div>
            <div class="bb-nav-mob__footer-item">
                {{--container-item 2--}}
                <span id="bb-nav-mob__mob-search-show"> @include('components.search')</span>

                <!-- Authentication Links -->
                @guest

                    @if (Route::has('login'))
                        <button class="bb-nav-mob__login bb-nav-mob__round-icon" data-toggle="modal"
                                data-target="#logineModalCenter">
                        </button>
                    @endif
                    @if (Route::has('register'))
                        <li>
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <div class="nav-item dropdown">

                        <a title="{{ Auth::user()->name }}" id="navbarDropdown"
                           class="nav-link dropdown-toggle bb-avatar" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{substr(Auth::user()->name, 0, 2)}}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item dropdown-item-custom"
                               href="{{ route('products_base.index') }}">{{ __('Все товары') }}</a>
                            @can('show-menu')
                                <a class="dropdown-item  dropdown-item-custom"
                                   href="{{ route('registered_users.index') }}">{{ __('Все пользователи') }}</a>
                            @endcan
                            <a class="dropdown-item  dropdown-item-custom" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
                <div class="bb-nav-mob__likes bb-nav-mob__round-icon">
                    <span class="material-icons">favorite</span>
                    <div class="bb-nav-mob__count-index">15</div>
                </div>
                <div class="bb-nav-mob__shopping-cart bb-nav-mob__round-icon">
                    <span class="material-icons">shopping_cart</span>
                    <div class="bb-nav-mob__count-index">2</div>
                </div>
            </div>
        </div>
     </div>
    <div style="background-color: #198754;  width: 100%; height: 1px; display: block; position: relative">
        <div class="bb-nav-mob__background-toggler"></div>
    </div>
@endsection
@yield('bb-nav-mob')


<style>

    .bb-nav-mob {
        display: none;
    }

    @media (max-width: 991px) {
        .bb-nav-mob {
            min-width: 100%;
            display: block;
            background: rgb(152, 142, 30) !important;
            background: linear-gradient(18deg, rgba(30, 152, 95, 1) 0%, rgba(25, 135, 84, 1) 35%, rgba(38, 193, 121, 1) 100%) !important;
            /*border: #1a1e21 solid 1px;*/
            height: 60px;
            overflow: hidden;
        }
    }

    @media (max-width: 767px) {
        .bb-nav-mob {
            padding: 0 .7rem 0 .7rem;
        }
    }

    .bb-nav-mob_open {
        height: fit-content;
        overflow: visible;

    }

    .bb-nav-mob__background-toggler {
        display: none;
    }

    .bb-nav-mob__background-toggler_opened {
        display: block;
        background-color: rgba(255, 255, 255, 0.01);
        position: absolute;
        height: 100vh;
        min-height: 100% !important;
        width: 100%;
        z-index: 100 !important;
        top: 0px;
        position: fixed;
    }

    .bb-nav-mob__header {
        display: flex;
        max-width: 700px;
        height: 60px;
        margin: 0 auto;
        /*background-color: #ab2836;*/
        flex-direction: row;
        flex-wrap: nowrap;
        box-shadow: rgba(0, 0, 0, 0.2) 0 25px 20px -20px;
    }

    .bb-nav-mob__header-item {
        display: flex;
        flex-direction: row;
        align-self: center;
    }

    .bb-nav-mob__header-item:nth-child(1) {
        order: 1;
        flex: 1 1 auto;
    }


    .bb-nav-mob__header-item:nth-child(2) {
        order: 2;
        flex: 0 1 auto;
    }

    .bb-nav-mob__mob-search {
        display: none;
    }

    @media (max-width: 500px) {
        .bb-nav-mob__mob-search {
            display: flex;
            max-width: 700px;
            height: 60px;
            margin: 0 auto;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: flex-end;
            box-shadow: rgba(0, 0, 0, 0.2) 0 25px 20px -20px;
        }
    }

    #bb-nav-mob__mob-search-show {
        display: flex;
    }

    @media (max-width: 500px) {
        #bb-nav-mob__mob-search-show {
            display: none;
        }
    }

    .bb-nav-mob__footer {
        display: flex;
        max-width: 700px;
        height: 60px;
        margin: 0 auto;
        flex-direction: row;
        flex-wrap: nowrap;
        /*background-color: #b01958;*/
        /*border-top: #0f5132 1px solid;*/
    }

    .bb-nav-mob__footer-item {
        display: flex;
        flex-direction: row;
        align-self: center;
    }


    .bb-nav-mob__footer-item:nth-child(1) {
        order: 1;
        flex: 0 1 auto;
    }


    .bb-nav-mob__footer-item:nth-child(2) {
        order: 2;
        flex: 1 1 auto;
        justify-content: flex-end;
    }


    .bb-nav-mob__logo {
        margin-right: 20px;
    }

    .bb-nav-mob__logo > img {
        width: 110px
    }

    .bb-nav-mob__catalog-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        width: fit-content;
        padding: 0 14px 0 14px;
        background-color: #24181DFF;
        font-size: 16px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .bb-nav-mob__catalog-btn > i {
        font-size: 20px;
        margin-right: 8px;
    }


    .bb-nav-mob__burger {
        display: flex !important;
    }

    .bb-nav-mob__burger > i {
        font-size: 29px;
        color: white;
    }

    .bb-nav-mob__burger_hide {
        display: none !important;
    }


    .bb-nav-mob__close {
        display: none !important;
    }

    .bb-nav-mob__close_show {

        display: flex !important;
        align-items: center;
        justify-content: center;
    }

    .bb-nav-mob__close_show > i {
        font-size: 25px;
        color: white;
    }

    .bb-nav-mob__round-icon {
        border: 0px;
        display: flex;
        height: 40px;
        width: 40px;
        border-radius: 20px;
        align-items: center;
        justify-content: center;
        margin: 0 0 0 14px;
        cursor: pointer;
        background: rgb(30, 152, 95) !important;
        background: linear-gradient(18deg, rgba(30, 152, 95, 1) 0%, rgba(25, 135, 84, 1) 35%, rgba(38, 193, 121, 1) 100%);
        position: relative;
        box-shadow: rgba(0, 0, 0, 0.35) 0 -50px 36px -28px inset;
    }

    .bb-nav-mob__round-icon_hiden {
        display: none !important;
    }

    .bb-nav-mob__search > i {
        font-size: 20px !important;
        color: white;
    }


    .bb-nav-mob__login {
        position: relative;
    }

    /*.bb-nav-mob__login > i {*/
    /*    font-size: 24px;*/
    /*    color: white;*/
    /*}*/


    .bb-nav-mob__login::before {
        font-family: "Material Icons";
        content: "\e7fd";
        color: #ffffff;
        font-size: 26px;
        /*margin-right: 4px;*/
    }

    .bb-nav-mob__count-index {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 193, 7, 0.69);
        padding: 0 1px 1px 1px;
        margin-top: -2px;
        border-radius: 2px;
        position: absolute;
        right: 0;
        top: 0;
        font-size: 10px;
        font-weight: bold;
        height: 13px;
        border: rgba(255, 193, 7, 0.8) solid 1px;
    }

    .bb-nav-mob__likes {
    }

    .bb-nav-mob__likes > span {
        margin: 1px 0 0 0;
        font-size: 22px;
        color: white;
    }

    .bb-nav-mob__shopping-cart {
    }

    .bb-nav-mob__shopping-cart > span {
        font-size: 24px;
        color: white;
        margin: 2px 0 0 0;
    }
</style>


