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

    public function update(Request $request, $id)
    {
        $data = $request->only('role_id', 'fullname');
        $user = User::find($id);

        if (!$user) {
            return response([
                'message' => 'User not found!'
            ]);
        }

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->has('username') && $request->username != $user->username) {
            $username = $this->checkUsername($request->username);
            if ($username) {
                return response([
                    'message' => 'Username already taken!'
                ]);
            }
            $data['username'] = $request->username;
        }

        if ($request->has('email') && $request->email != $user->email) {
            $email = $this->checkEmail($request->email);
            if ($email) {
                return response([
                    'message' => 'Email already taken!'
                ]);
            }
            $data['email'] = $request->email;
        }

        $user->update($data);

        return response($user);
    }

    private function checkUsername($username)
    {
        $user = User::where('username', $username)->first();
        return $user;
    }

    private function checkEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response([
                'message' => 'User not found!'
            ]);
        }

        $user->delete();

        return response(['message' => "User with id: $id deleted!"]);
    }
}