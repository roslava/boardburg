<!doctype html>
<html lang="en">
@include('parts.head')
<body>
<div class="wrapper">

    <div class="content">

        <header>

            <div class="header container-fluid p-0" style="min-height: 250px">
                @section('header')

                @endsection
                @yield('header','here is header section')
            </div>

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


</body>

</html>




