@extends('layouts.base')

@section('header')
    @include('components.header')
@endsection

@section('main')
    <div class="container-md">
        @include('components.filters')
        @include('components.search')
        <div class="row mb-3 ">
            @include('components.product_card')
            <div class="row mt-3"> {{ $skatesFromBase->links()}}</div>
            @include('components.accordion')
            @include('components.mail_send')
         </div>
    </div>
@endsection

@section('footer')
    <div class="container-md">Футер</div>
@endsection
