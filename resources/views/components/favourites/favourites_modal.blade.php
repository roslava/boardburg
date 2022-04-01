@section('favourites_modal')
    <div class="modal fade" id="favourites_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
         style="background-color: rgba(24,126,79,0.73)!important;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"
                     style="border: 0; padding-left: 1.5rem; padding-right: 1.5rem; display: flex; align-items: start">
                    <h5 class="modal-title" id="exampleModalLongTitle">Товар добавлен в избранное</h5>
                    <div style="width: fit-content; padding: 0; margin-left: 10px ">
                        <i style="font-size: 1.4rem; cursor: pointer"
                           class="bi bi-x-square modal__close-btn modal_cl_btn"
                           data-dismiss="modal" aria-label="Close"></i>
                    </div>
                </div>
                <div class="card-body">
{{--                    <button> Продолжить покупки</button>--}}
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
@yield('favourites_modal')
