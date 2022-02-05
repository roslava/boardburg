@extends('layouts.base')


@section('main')
    <div class="container-md bg-light p-4 rounded">


        <table class="table">
            <thead>
            <tr>
                <th class="col-md-1" scope="col">#</th>
                <th class="col-md-3" scope="col">Name</th>
                <th class="col-md-3" scope="col">Role</th>
                <th class="col-md-3" scope="col">E-mail</th>
                <th class="col-md-5" scope="col">Actions</th>
            </tr>
            </thead>
        </table>

        @foreach($registered_users as $registered_user)




            <table class="table">

                <tbody>
                <tr>
                    <td class="col-md-1">{{$registered_user->id}}</td>
                    <td class="col-md-3">{{$registered_user->name}}</td>
                    <td class="col-md-3">{{$registered_user->role}}</td>
                    <td class="col-md-3">{{$registered_user->email}}</td>
                    <td class="col-md-5">
                        <div style="display: flex">
                            <a class="btn btn-success m-1" style="min-width: 70px"
                               href="{{route('registered_user.edit', $registered_user->id)}}">Edit</a>
                            <form action="{{route('registered_user.destroy', $registered_user->id )}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger  m-1" style="min-width: 70px">Delete</button>
                            </form>
                        </div>

                    </td>

                </tr>
                </tbody>
            </table>
        @endforeach

        <a class="btn btn-success" href="{{route('registered_user.create')}}">Create New User</a>


    </div>
@endsection

@section('footer')
    <div class="container-md">Футер</div>
@endsection
