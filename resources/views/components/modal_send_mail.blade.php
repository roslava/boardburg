@section('modal_send_mail')
<!-- Modal send mail -->
<div class="modal fade" id="mailModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
     style="background-color: rgba(24,126,79,0.73)!important;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header"
                 style="border: 0; padding-left: 1.5rem; padding-right: 1.5rem; display: flex; align-items: start">
                <h5 class="modal-title" id="exampleModalLongTitle">Задать вопрос</h5>
                <div style="width: fit-content; padding: 0; margin-left: 10px ">
                    <i style="font-size: 1.4rem; cursor: pointer; " class="bi bi-x-square modal__close-btn"
                       data-dismiss="modal" aria-label="Close"></i>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="mb-1" for="name">Имя:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                               required maxlength="100" value="{{ old('name') ?? '' }}">
                        @error('name')
                        <span
                            class="invalid-feedback"
                            role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-1 mt-3" for="email">E-mail:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                               required maxlength="100" value="{{ old('email') ?? '' }}">
                        @error('email')
                        <span
                            class="invalid-feedback"
                            role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-1 mt-3" for="subject">Тема:</label>
                        <input type="text" class="form-control  @error('subject') is-invalid @enderror" name="subject"
                               required maxlength="100" value="{{ old('subject') ?? '' }}">
                        @error('subject')
                        <span
                            class="invalid-feedback"
                            role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-1 mt-3" for="message">Ваше сообщение:</label>
                        <textarea class="form-control  @error('message') is-invalid @enderror" name="message"
                                  required maxlength="500" rows="3">{{ old('message') ?? '' }}</textarea>
                        @error('message')
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
@endsection
@yield('modal_send_mail')
