@section('bb-catalog-btn')
    <div class="bb-catalog-btn">
        <span class="bb-catalog-btn_text">Каталог</span>
    </div>
@endsection
@yield('bb-catalog-btn')

<style>
    .bb-catalog-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        width: fit-content;
        padding: 0 14px 0 14px;
        background-color: #24181DFF;
        font-size: 16px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .bb-catalog-btn::before {
        font-family: "Material Icons";
        content: "\e065";
        color: #ffffff;
        font-size: 20px;
        margin-right: 4px;
    }

    .bb-catalog-btn_close {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        width: fit-content;
        padding: 0 14px 0 14px;
        background-color: #24181DFF;
        font-size: 16px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .bb-catalog-btn_close::before {
        font-family: "Material Icons";
        content: "\eb80";
        color: #ffffff;
        font-size: 20px;
        margin-right: 4px;
    }

    .bb-catalog-btn_text {
        display: inline;
    }

    @media (max-width: 991px) {
        .bb-catalog-btn_text {
            display: none;
        }

        .bb-catalog-btn::before {
            margin-right: -3px;
        }
    }
</style>
