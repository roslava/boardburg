@section('nav')
    <nav class="navbar navbar-expand-md navbar__nav bg-white shadow-sm">
        <div class="container" >





            <div class="navbar-items-holder">
                <div>
                <a class="navbar-brand" id="bb-top-logo"  href="{{ url('/') }}">
                   <div class="navbar__top-logo" id="bb-top-logo">

                       <img style="width: 110px" src="{{ asset('img/boardburg_logo_w.svg') }}" alt="">
                   </div>
                </a>
                </div>

                <div style="display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
            align-items: center;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
            flex-direction: row;
    -webkit-box-pack: end;
    -ms-flex-pack: end;
            justify-content: flex-end;">

                    <div class="bb-search__container" id="bb-search__container">
                        <div class="bb-search__wrapper">
                            <i class="bi bi-x-circle bb-search__close-icon" id="bb-search__close-icon">
                            </i>
                            @include('components.search')
                        </div>
                    </div>

                    <a class="navbar-brand bb-search__icon" id="bb-search__icon" href="{{ url('#') }}">
                        <i class="bi bi-search"></i>
                    </a>

                    <span style="margin-right: 1rem; color: rgba(255,255,255,0.6)">|</span>
                    <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>








            <div class="collapse navbar-collapse navbar-collapse-custom" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <button class="login-inp-button" data-toggle="modal" data-target="#logineModalCenter">
                                    <i class="bi bi-key" style="font-size: 22px"></i>
                                </button>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
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
                        </li>
                    @endguest
                </ul>
            </div>
        </div>


    </nav>
@endsection
@yield('nav')

<!-- Modal -->
<div class="modal fade" id="logineModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
     style="background-color: rgba(24,126,79,0.73)!important;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header"
                 style="border: 0; padding-left: 1.5rem; padding-right: 1.5rem; display: flex; align-items: start">
                <h5 class="modal-title" id="exampleModalLongTitle">Вход</h5>
                <div style="width: fit-content; padding: 0; margin-left: 10px ">
                    <i style="font-size: 1.4rem; cursor: pointer; " class="bi bi-x-square modal__close-btn"
                       data-dismiss="modal" aria-label="Close"></i>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Адрес e-mail') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn login-modal__btn">
                                {{ __('Войти') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
