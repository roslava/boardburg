<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Http\RedirectResponse;

class RegisteredUserController extends Controller
{

    public function index()
    {
        $registered_users = User::all();
        return view('registered_users', ['registered_users' => $registered_users]);
    }


    public function create()
    {
        return view('create_registered_user');
    }


    public function store(Request $request)
    {
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
        $registered_users = User::all()->where('id', $id)->first();
        return view('registered_user_edit', compact('registered_users'));

    }




    public function update(Request $request, $id):RedirectResponse
    {
        $request->validate([
            'name' => 'required',
             //'role' => 'required' — was my error
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


    public function destroy($id):RedirectResponse
    {
        $registered_users = User::all()->where('id', $id)->first();
        $registered_users->delete();
        return redirect()->route('registered_users.index');
    }
}
