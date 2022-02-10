@extends('layouts.base')
@section('header')
    @include('components.header')
@endsection
@section('main')
    <div class="container-md">

        <div class="row mb-3 " style="padding-top: 1.6rem">
            @include('components.product_card')
            <div class="row mt-3"> {{ $skatesFromBase->links()}}</div>
            @if (!Auth::guest() )
                @include('components.accordion')
            @else
            @endif
            @include('components.mail_send')
        </div>
    </div>
@endsection
@section('footer')
    @include('components.footer')
@endsection
