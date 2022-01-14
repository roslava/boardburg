<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registered_users = User::all();
        return view('registered_users', ['registered_users' => $registered_users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_registered_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registered_users = User::all()->where('id', $id)->first();
        return view('registered_user_edit', compact('registered_users'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request['name'];
        $user->role = $request['role'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        return redirect()->route('registered_users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registered_users = User::all()->where('id', $id)->first();
        $registered_users->delete();
        return redirect()->route('registered_users.index');
    }
}
