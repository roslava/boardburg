@section('header')
    <div class="header-bg container-fluid  p-0 m-0" style="background-image:url({{url('img/lave.png')}})">


        <div style="display: flex; flex-direction: column; justify-content: center;" class="container-md">

                        @include('components.filters')
                        @include('components.search')

        </div>

    </div>
