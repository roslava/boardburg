<!doctype html>
<html lang="en">
@include('parts.head')
<body>
<div class="wrapper">
    <div class="content">
        @include('components.nav.bb-nav-desc')
        @include('components.nav.bb-nav-mob')
        @include('components.catalog.bb-catalog')

        <header>
{{--            <div class="">--}}
                @section('header')
                @endsection
                @yield('header','here is header section')
{{--            </div>--}}
        </header>
        <main>
            <div class="main container-fluid p-0">
                @section('main')
                @endsection
                @yield('main','here is main section')
            </div>
        </main>
    </div>
    <footer>
        <div class="footer_ container-fluid p-0">
            @section('footer')
            @endsection
            @yield('footer','here is footer section')
        </div>
    </footer>
</div>

@include('components.shopping_cart.cart_add_confirm_modal')



<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="/js/app.js"></script>
@yield('fp_scripts')
</body>
</html>
