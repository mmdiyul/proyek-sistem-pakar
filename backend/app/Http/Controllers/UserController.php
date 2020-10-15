<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Roles;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->load('role');
        return response([
            'length' => count($users),
            'data' => $users
        ]);
    }

    public function show($id)
    {
        $user = User::find($id)->load('role');

        if (!$user) {
            return response([
                'message' => 'User not found!'
            ]);
        }

        return response($user);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role_id'   => 'required | numeric | exists:' . Roles::class . ',id',
            'fullname'  => 'required | string',
            'username'  => 'required | string | unique:' . User::class,
            'email'     => 'required | email | unique:' . User::class,
            'password'  => 'required | string'
        ]);

        $data = $request->only('role_id', 'fullname', 'username', 'email');
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        return response($user, 201);
    }
}