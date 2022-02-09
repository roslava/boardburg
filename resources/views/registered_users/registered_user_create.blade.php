@extends('layouts.base')


@section('main')
    <div class="container-md bg-light  p-4 rounded">

        <form method="GET" action="{{ route('registered_user.store') }}">
            @csrf

            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text"
                           class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                </div>
            </div>


            <div class="row mb-3">
                <label for=role"
                       class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                <div class="col-md-6">


                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RoleRadios" id="role_admin" value="admin"
                               checked>
                        <label class="form-check-label" for="role_admin">
                            admin
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RoleRadios" id="role_manager"
                               value="manager">
                        <label class="form-check-label" for="role_manager">
                            manager
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RoleRadios" id="role_guest" value="guest">
                        <label class="form-check-label" for="role_guest">
                            guest
                        </label>
                    </div>


                    @error('role')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label for="email"
                       class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span
                        class="invalid-feedback"
                        role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password"
                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm"
                       class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="row mb-0">


{{--                @if ($errors->any())--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <ul>--}}
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                @endif--}}


                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success">
                        {{ __('Create') }}
                    </button>
                    <a class="btn btn-info" href="{{route('registered_users.index')}}">Cancel</a>
                </div>
            </div>
        </form>
    </div>

@endsection
