@section('mail_send')
{{--    @can('show_message_send')--}}


        @if (\Auth::guest() )

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
                <label for="name_for_feedback" class="form-label mt-4" style="color: white">Укажите ваше имя.</label>
                <div><input type="text" class=" col-md-4 " id="name_for_feedback" name="name_for_feedback"></div>


                <div class="form-group mt-4 mb-4">
                    <div class="captcha">
                        <span>{!! captcha_img() !!}</span>
                        <button type="button" class="btn btn-danger" class="reload" id="reload">
                            &#x21bb;
                        </button>
                    </div>
                </div>
{{--///????--}}

            </div>
            <div class="mb-2" style="color: #198754">
                @if(Illuminate\Support\Facades\Session::has('message_sent'))
                    <small> {{Illuminate\Support\Facades\Session::get('message_sent')}} </small>
                @endif
            </div>
            <button class="btn btn-success mt-2 mb-5">Отправить</button>
        </form>
        @endif
{{--    @endcan--}}
@endsection
@yield('mail_send')

