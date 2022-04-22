@section('cart_add_confirm_modal')
    <div class="modal fade" id="cart_add_confirm_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
         style="background-color: rgba(24,126,79,0.73)!important;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"
                     style="border: 0; padding-left: 1.5rem; padding-right: 1.5rem; display: flex; align-items: start">
                    <h6 class="modal-title" id="cartAddConfirmTitle"></h6>
{{--                    <div style="width: fit-content; padding: 0; margin-left: 10px ">--}}
{{--                        <i style="font-size: 1.4rem; cursor: pointer"--}}
{{--                           class="bi bi-x-square modal__close-btn modal_cl_btn modalCloseConfirm-close-btn"--}}
{{--                           data-dismiss="modal" aria-label="Close"></i>--}}
{{--                    </div>--}}
                </div>
                <div class="card-body">
                    <div class="confirm__btn-all-btn-holder">
                        <button class="confirm__btn confirm__btn_continue modalCloseConfirm-close-btn">
                            Продолжить покупки
                        </button>
                        <div class="confirm__btn_bottom-holder">
                            <a class="confirm__btn confirm__btn_to-cart" href="{{ route('cart.index')}}">Перейти в
                                корзину</a>
                            <form class="shopping-cart__delete-btn-form-modal" method="POST">
                                @csrf
                                @method("POST")
                                <input id="id" class="shopping-cart__delete-btn-hid" type="hidden" value="" name="id">
                                <input class="shopping-cart__delete-btn-hid input-window-location" type="hidden"
                                       value=""
                                       name="window_location">
                                <button class="confirm__btn confirm__btn_dell" id="modalCloseConfirm-remove-btn">Убрать
                                    из
                                    корзины
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@yield('cart_add_confirm_modal')


<style>
    .confirm__btn {
        border: 0;
        /*background-color: #0c63e4;*/
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        cursor: pointer;
        margin: 10px;
    }

    .confirm__btn_dell {
        color: #ee533c;
        /*color: #f3b3ab;*/
        /*background-color: #ee533c;*/
        height: 20px;
        background-color: #eeeeee;
    }

    .confirm__btn_dell:hover {
        color: #ffffff;
        background-color: #d94a38;
    }

    .confirm__btn_continue {
        color: #a5f6cc;
        background: rgb(30, 152, 95) !important;
        background: linear-gradient(18deg, rgba(30, 152, 95, 1) 0%, rgba(25, 135, 84, 1) 35%, rgb(25, 135, 84) 100%) !important;
        height: 60px;
        padding: 15px;
        padding-left: 25px;
        padding-right: 25px;
        /*padding-bottom: 50px;*/
        font-size: 20px;
    }

    .confirm__btn_continue:hover {
        color: #ffffff;
        background: rgb(30, 152, 95) !important;
        background: linear-gradient(18deg, rgb(26, 141, 88) 0%, rgb(21, 126, 77) 35%, rgb(19, 119, 73) 100%) !important;
    }

    .confirm__btn_to-cart {
        color: #212529;
        /*background-color: #212529;*/
        max-width: 200px;
        width: fit-content;
        text-decoration: none;
        height: 20px;
        background-color: #eeeeee;
    }

    .confirm__btn_to-cart:hover {
        color: #ffffff;
        background-color: #191c1f;
    }

    .confirm__btn-all-btn-holder {
        display: flex;
        flex-direction: column;
        width: 100%;
        align-items: center;
        justify-content: center;
    }

    .confirm__btn_bottom-holder {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        margin-top: 30px;
    }
</style>

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">--}}


{{--    function closeModalConfirm() {--}}
{{--        $('.cart_add_confirm_modal').modal('hide');--}}
{{--        $('body').removeClass('modal-open');--}}
{{--        $('.modal-backdrop').hide();--}}
{{--        alert('ddd')--}}
{{--    }--}}

{{--</script>--}}


{{--<script>--}}

{{--function closeModalConfirm(){--}}
{{--    let modal = document.getElementById("cart_add_confirm_modal")--}}
{{--    // document.getElementById("cart_add_confirm_modal").style.display = "none"--}}
{{--    // document.getElementById("cart_add_confirm_modal").classList.remove("show")--}}

{{--    // Get the backdrop so we can remove it from the body--}}
{{--    const backdrop = document.querySelector('.modal-backdrop.fade.show');--}}
{{--    // Remove the `modal-open` class from the body--}}
{{--    document.body.classList.remove('modal-open');--}}
{{--    // Re-hide the modal from screen readers--}}
{{--    modal.setAttribute('aria-hidden', 'true');--}}
{{--    // Remove the `show` class from the backdrop--}}
{{--    backdrop.classList.remove('show');--}}
{{--    // Remove the `show` class from the modal--}}
{{--    modal.classList.remove('show');--}}
{{--    // Change the modal `display` style to `none`--}}
{{--    modal.style.display = 'none';--}}
{{--    // Remove the backdrop div from the body--}}
{{--    backdrop.remove();--}}

{{--}--}}
{{--</script>--}}
