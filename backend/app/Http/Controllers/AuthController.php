<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $user = User::findByEmailOrUsername($request->getUser());

        if (!$user) {
            return response([
                'message' => 'Email or Username is invalid!'
            ], 401);
        }

        if (!$this->correctPassword($request->getPassword(), $user->password)) {
            return response([
                'message' => 'Password is invalid!'
            ], 401);
        }

        $user->update([
            'last_logged_in' => Carbon::now()
        ]);

        return response([
            'token' => $this->jwt($user, $request->remember_me),
            'user'  => $user->load('role')
        ]);
    }

    private function correctPassword($password, $hashedPassword)
    {
        return Hash::check($password, $hashedPassword);
    }

    private function jwt(User $user, $isRemembered)
    {
        $payload = [
            'iss' => 'lumen-jwt',
            'sub' => $user->id,
            'iat' => time(),
            'exp' => $isRemembered ? Carbon::now()->timestamp + 60*60*24*12 : Carbon::now()->timestamp + 60*60*12
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }
}