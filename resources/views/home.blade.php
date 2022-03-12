@extends('layouts.base')
@section('header')
    @include('components.header')
@endsection
@section('main')
    <div class="container-md">
        @if (Auth::guest() )
            <div class="intro-bb">
               <div class="intro-bb__format"> Демонстрационный проект BoardBurg.&ensp;</div>
                <div class="intro-bb__format">Логин:&thinsp;<span class="intro-bb__select">admin@bb.com</span>,&ensp;</div>
                <div class="intro-bb__format"> пароль:&thinsp;<span class="intro-bb__select">88888888</span>&ensp;</div>
            </div>
        @endif
        <div class="row mb-3 " style="padding-top: 1.6rem">
            @include('components.product_card')
            <div class="row mt-3"> {{ $productsFromBase->links()}}</div>
            @if (!Auth::guest() )
                @include('components.accordion')
                     @endif
            @if (Auth::guest() )
                <div class="mb-3 contacts__btn" data-toggle="modal" data-target="#mailModalCenter">
                    Задать вопрос
                </div>
      @endif
        </div>
    </div>
@endsection
@section('footer')
    @include('components.footer')
@endsection

@include('components.modal_send_mail')

{{--@if ($errors->any())--}}


{{--    <div class=" modal-dialog modal-dialog-centered">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}


{{--@endif--}}
