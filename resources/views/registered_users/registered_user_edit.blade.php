@extends('layouts.base')


@section('main')
    <div class="container-md bg-light   p-4 rounded">
        <h1>Edit user</h1>
        <form action="{{ route('registered_user.update', $registered_users->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text"
                           class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ $registered_users->name }}">
                    @error('name')
                    <span
                        class="invalid-feedback"
                        role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
            </div>
            <div class="row mb-3">
                <label for=role"
                       class="col-md-4 col-form-label text-md-end">Role</label>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RoleRadios" id="role_admin" value="admin"
                               @if($registered_users['role'] == 'admin') checked @endif>
                        <label class="form-check-label" for="role_admin">
                            admin
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RoleRadios" id="role_manager" value="manager"
                               @if($registered_users['role'] == 'manager') checked @endif>
                        <label class="form-check-label" for="role_manager">
                            manager
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="RoleRadios" id="role_guest" value="guest"
                               @if($registered_users['role'] == 'guest') checked @endif>
                        <label class="form-check-label" for="role_guest">
                            guest
                        </label>
                    </div>

                </div>

            </div>


            <div class="row mb-3">
                <label for="email"
                       class="col-md-4 col-form-label text-md-end">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ $registered_users->email }}">
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
                       class="col-md-4 col-form-label text-md-end">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" value="">
                    @error('password')
                    <span
                        class="invalid-feedback"
                        role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                      </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm"
                       class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation">
                    @error('password_confirmation')
                    <span
                        class="invalid-feedback"
                        role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">

                    <button type="submit" class="btn btn-success">
                        Save
                    </button>

                    <a class="btn btn-info" href="{{route('registered_users.index')}}">Cancel</a>

                </div>
            </div>
        </form>
    </div>

@endsection











{{--@extends('layouts.base')--}}


{{--@section('main')--}}
{{--    <div class="container-md bg-light   p-4 rounded">--}}

{{--        <form action="{{ route('registered_user.update', $registered_users->id) }}" method="POST">--}}
{{--            @csrf--}}
{{--            @method('PUT')--}}

{{--            <div class="row mb-3">--}}
{{--                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>--}}

{{--                <div class="col-md-6">--}}
{{--                    <input id="name" type="text"--}}
{{--                           class="form-control @error('name') is-invalid @enderror" name="name"--}}
{{--                           value="{{ $registered_users->name }}" autofocus>--}}
{{--                    @error('name')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                    @enderror--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row mb-3">--}}
{{--                <label for=role"--}}
{{--                       class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-check">--}}
{{--                        <input class="form-check-input" type="radio" name="RoleRadios" id="role_admin" value="admin"--}}
{{--                               @if($registered_users['role'] == 'admin') checked @endif>--}}
{{--                        <label class="form-check-label" for="role_admin">--}}
{{--                            admin--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    <div class="form-check">--}}
{{--                        <input class="form-check-input" type="radio" name="RoleRadios" id="role_manager" value="manager"--}}
{{--                               @if($registered_users['role'] == 'manager') checked @endif>--}}
{{--                        <label class="form-check-label" for="role_manager">--}}
{{--                            manager--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    <div class="form-check">--}}
{{--                        <input class="form-check-input" type="radio" name="RoleRadios" id="role_guest" value="guest"--}}
{{--                               @if($registered_users['role'] == 'guest') checked @endif>--}}
{{--                        <label class="form-check-label" for="role_guest">--}}
{{--                            guest--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    @error('role')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--            </div>--}}


{{--            <div class="row mb-3">--}}
{{--                <label for="email"--}}
{{--                       class="col-md-4 col-form-label text-md-end">E-Mail Address</label>--}}

{{--                <div class="col-md-6">--}}
{{--                    <input id="email" type="email"--}}
{{--                           class="form-control @error('email') is-invalid @enderror" name="email"--}}
{{--                           value="{{ $registered_users->email }}">--}}

{{--                    @error('email')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row mb-3">--}}
{{--                <label for="password"--}}
{{--                       class="col-md-4 col-form-label text-md-end">Password</label>--}}

{{--                <div class="col-md-6">--}}
{{--                    <input id="password" type="password"--}}
{{--                           class="form-control @error('password') is-invalid @enderror"--}}
{{--                           name="password" value="">--}}

{{--                    @error('password')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row mb-3">--}}
{{--                <label for="password-confirm"--}}
{{--                       class="col-md-4 col-form-label text-md-end">Confirm Password</label>--}}

{{--                <div class="col-md-6">--}}
{{--                    <input id="password-confirm" type="password" class="form-control"--}}
{{--                           name="password_confirmation">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row mb-0">--}}
{{--                <div class="col-md-6 offset-md-4">--}}

{{--                    <button type="submit" class="btn btn-success">--}}
{{--                        Save--}}
{{--                    </button>--}}

{{--                    <a class="btn btn-info" href="{{route('registered_users.index')}}">Cancel</a>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

{{--@endsection--}}
