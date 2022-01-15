@section('accordion')

<div class="accordion accordion-flush mb-5" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                    aria-controls="flush-collapseOne">
                <small>Количество наименований: &nbsp;{{$quantity}}. &nbsp; </small>
                @if (session('success'))
                    <small class="m-0">{{session('success')}}</small>
                @endif
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
             data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">

                <div style="display: flex; flex-direction: row">
                    <form action="{{ route('skates_base.update_all')}}" method="get"
                          style="margin-right: 20px">


                        {{--            @csrf--}}
                        <button class="btn btn-success" style="width:120px">Update All</button>
                    </form>


                    <a class="btn btn-warning" style="display: block; width:120px"
                       href="{{route('skates_form.create')}}">Create
                        New</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@yield('accordion')
