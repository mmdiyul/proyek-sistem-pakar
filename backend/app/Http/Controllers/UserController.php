<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}