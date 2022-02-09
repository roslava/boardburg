<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;


class RegisteredUserController extends Controller
{
    public function index()
    {
        $registered_users = User::all();
        Gate::authorize('registered_user-allow');
        return view('registered_users.registered_users', ['registered_users' => $registered_users]);
    }

    public function create()
    {
        Gate::authorize('registered_user-allow');
        return view('registered_users.registered_user_create');
    }

    public function store(UserStore $request)
    {
        Gate::authorize('registered_user-allow');
        $users = new User;
        $users::create([
            'name' => $request['name'],
            'role' => $request->input('RoleRadios'),
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('registered-users');
    }

    public function edit($id)
    {
        Gate::authorize('registered_user-allow');
        $registered_users = User::all()->where('id', $id)->first();
        return view('registered_users.registered_user_edit', compact('registered_users'));
    }

    public function update(UserUpdate $request, $id): RedirectResponse
    {
        Gate::authorize('registered_user-allow');
        $request->validate([
            'name' => 'required',
            'RoleRadios' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::all()->find($id);
        $user['name'] = $request['name'];
        $user['role'] = $request->input('RoleRadios');
        $user['email'] = $request['email'];
        $user['password'] = Hash::make($request['password']);
        $user->update();
        return redirect()->route('registered_users.index');
    }

    public function destroy($id): RedirectResponse
    {
        Gate::authorize('registered_user-allow');
        $registered_users = User::all()->where('id', $id)->first();
        $registered_users->delete();
        return redirect()->route('registered_users.index');
    }
}
