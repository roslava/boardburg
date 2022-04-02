@section('bb-nav-desc')

    <div class="bb-nav-desc">
        <div class="bb-nav-desc__container">
            <div class="bb-nav-desc__container-item">
                {{--            container-item 1--}}

                <a class="navbar-brand" id="bb-top-logo" href="{{ url('/') }}">
                    <div class="bb-nav-desc__logo">
                        <img src="{{ asset('img/boardburg_logo_w.svg') }}" alt="">
                    </div>
                </a>
                @include('components.catalog.bb-catalog-btn')

            </div>
            <div class="bb-nav-desc__container-item">
                {{--container-item 2--}}
                @include('components.search')
            </div>
            <div class="bb-nav-desc__container-item">
            {{--container-item 3--}}

            <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <button class="bb-nav-desc__login bb-nav-desc__round-icon" data-toggle="modal"
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


                <div class="bb-nav-desc__likes bb-nav-desc__round-icon">
                    <span class="material-icons">favorite</span>
                    <div class="bb-nav-desc__count-index">15</div>
                </div>

                <a style="text-decoration: none" href="{{ route('cart.index')}}"> <div class="bb-nav-desc__shopping-cart bb-nav-desc__round-icon">
                    <span class="material-icons">shopping_cart</span>
                    <div class="bb-nav-desc__count-index">
                        {{\Cart::session(\Illuminate\Support\Facades\Session::getId())->getTotalQuantity()}}
                    </div>
                </div>
                </a>

            </div>
        </div>
    </div>
@endsection
@yield('bb-nav-desc')


<style>
    .bb-nav-desc {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-content: stretch;
        align-items: flex-start;
        background: rgb(30, 152, 95) !important;
        background: linear-gradient(18deg, rgba(30, 152, 95, 1) 0%, rgba(25, 135, 84, 1) 35%, rgba(38, 193, 121, 1) 100%) !important;
        min-height: 60px;
        height: 60px;
        position: fixed;
        width: 100%;
        z-index: 1000;
    }

    @media (max-width: 991px) {
        .bb-nav-desc {
            display: none;
        }
    }


    .bb-nav-desc__container {
        display: flex;
        flex: 1 auto;
        max-width: 1300px;
        height: 60px;
        align-items: center;
    }


    @media (max-width: 1399px) {
        .bb-nav-desc__container {
            max-width: 1110px;
        }
    }

    @media (max-width: 1199px) {
        .bb-nav-desc__container {
            max-width: 939px;
        }
    }

    @media (max-width: 991px) {
        .bb-nav-desc__container {
            max-width: 700px;
        }
    }


    .bb-nav-desc__container-item {
        display: flex;
    }

    .bb-nav-desc__container-item:nth-child(1) {
        order: 0;
        flex: 0 1 auto;
        align-self: auto;

    }

    .bb-nav-desc__container-item:nth-child(2) {
        order: 0;
        flex: 1 1 auto;
        align-self: auto;
        justify-content: flex-end;
        align-items: center;
    }

    .bb-nav-desc__container-item:nth-child(3) {
        order: 0;
        flex: 0 1 auto;
        align-self: auto;

    }

    .bb-nav-desc__logo {
        margin-right: 20px;
    }

    .bb-nav-desc__logo > img {
        width: 110px
    }


    .bb-nav-desc__round-icon {
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
        box-shadow: rgba(0, 0, 0, 0.35) 0px -50px 36px -28px inset;
    }

    .bb-nav-desc__round-icon_hiden {
        display: none !important;
    }

    .bb-nav-desc__search {
    }

    .bb-nav-desc__search > a {
        font-size: 20px !important;
        color: white;
    }

    /*___________*/
    .bb-nav-desc__login {
        position: relative;
    }

    .bb-nav-desc__login::before {
        font-family: "Material Icons";
        content: "\e7fd";
        color: #ffffff;
        font-size: 26px;
        /*margin-right: 4px;*/
    }

    .bb-nav-desc__count-index {
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

    .bb-nav-desc__likes {
    }

    .bb-nav-desc__likes > span {
        margin: 1px 0 0 0;
        font-size: 22px;
        color: white;
    }

    .bb-nav-desc__shopping-cart {
    }

    .bb-nav-desc__shopping-cart > span {
        font-size: 24px;
        color: white;
        margin: 2px 0 0 0;
    }

    .bb-avatar {
        color: white;
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
        box-shadow: rgba(0, 0, 0, 0.35) 0px -50px 36px -28px inset;
    }
</style>
