@section('modal_send_mail')
    <div class="modal fade" id="mailModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
         style="background-color: rgba(24,126,79,0.73)!important;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"
                     style="border: 0; padding-left: 1.5rem; padding-right: 1.5rem; display: flex; align-items: start">
                    <h5 class="modal-title" id="exampleModalLongTitle">Задать вопрос</h5>
                    <div style="width: fit-content; padding: 0; margin-left: 10px ">
                        <i style="font-size: 1.4rem; cursor: pointer"
                           class="bi bi-x-square modal__close-btn modal_cl_btn"
                           data-dismiss="modal" aria-label="Close"></i>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1" for="name_modal_send_mail">Имя:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name_modal_send_mail" name="name"
                                   maxlength="100" value="{{ old('name') ?? '' }}">
                            @error('name')
                            <span
                                class="invalid-feedback"
                                role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-1 mt-3" for="email_modal_send_mail">E-mail:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email_modal_send_mail" name="email"
                                   maxlength="100" value="{{ old('email') ?? '' }}">
                            @error('email')
                            <span
                                class="invalid-feedback"
                                role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-1 mt-3" for="subject_modal_send_mail">Тема:</label>
                            <input type="text" class="form-control  @error('subject') is-invalid @enderror"
                                   id="subject_modal_send_mail"
                                   name="subject"
                                   maxlength="100" value="{{ old('subject') ?? '' }}">
                            @error('subject')
                            <span
                                class="invalid-feedback"
                                role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-1 mt-3" for="message_modal_send_mail">Ваше сообщение:</label>
                            <textarea class="form-control  @error('message') is-invalid @enderror"
                                      id="message_modal_send_mail" name="message"
                                      maxlength="500" rows="3">{{ old('message') ?? '' }}</textarea>
                            @error('message')
                            <span
                                class="invalid-feedback"
                                role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="form-group mt-4 mb-4">
                            <div class="captcha">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-danger reload" id="reload_modal_send_mail">
                                    &#x21bb;
                                </button>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="captcha_modal_send_mail"></label>
                            <input type="text" class="form-control @error('captcha') is-invalid @enderror"
                                   placeholder="Введите, пожалуйста, три символа" id="captcha_modal_send_mail"
                                   name="captcha">
                            @error('captcha')
                            <span
                                class="invalid-feedback"
                                role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn login-modal__btn">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="successMailModal" tabindex="-1" role="dialog"
         aria-labelledby="successMailModal" aria-hidden="true"
         style="background-color: rgba(24,126,79,0.73)!important;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"
                     style="border: 0; padding-left: 1.5rem; padding-right: 1.5rem; display: flex; align-items: start">
                    <h5 class="modal-title"><i class="bi bi-emoji-smile"></i></h5>
                    <div style="width: fit-content; padding: 0; margin-left: 10px ">
                        <i style="font-size: 1.4rem; cursor: pointer"
                           class="bi bi-x-square modal__close-btn modal_cl_btn"
                           data-dismiss="modal" aria-label="Close"></i>
                    </div>
                </div>
                <div class="card-body">
                    {{ session()->get('success_mail_send') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@yield('modal_send_mail')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    $('#reload_modal_send_mail').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>

@if($errors->any())
    <script>
        $(document).ready(function () {
            $('#mailModalCenter').modal('show');
            $('.modal_cl_btn').click(function () {
                $('#mailModalCenter').modal('hide');
                window.location.assign(window.location.href)
            })
        })
    </script>
@endif

@if(session()->has('success_mail_send'))
    <script>
        $(document).ready(function () {
            $('#successMailModal').modal('show');
            $('.modal_cl_btn').click(function () {
                $('#successMailModal').modal('hide');
            })
        })
    </script>
@endif
