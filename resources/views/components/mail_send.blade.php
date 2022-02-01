@section('mail_send')
    @can('show_message_send')
        <form action="{{route('message_send.index')}}" enctype="multipart/form-data" method="POST">
            @method("POST")
            @csrf
            <div class="mb-3">
                <label for="message_for_admin" class="form-label" style="color: white">Отправить собщение
                    администратору</label>
                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                <label for="email_for_feedback" class="form-label mt-4" style="color: white">Укажите e-mail адрес для
                    обратной связи.</label>
                <div><input type="email" class=" col-md-4 " id="email_for_feedback" name="email_for_feedback"></div>
            </div>
            <div class="mb-2" style="color: #198754">
                @if(Illuminate\Support\Facades\Session::has('message_sent'))
                    <small> {{Illuminate\Support\Facades\Session::get('message_sent')}} </small>
                @endif
            </div>
            <button class="btn btn-success mt-2 mb-5">Отправить</button>
        </form>
    @endcan
@endsection
@yield('mail_send')

