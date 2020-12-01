<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function __construct()
    {   
        $this->middleware('auth')->except('login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'attributes' => [
                'password' => 'senha'
            ]
        ]);
        $jwt = Auth::attempt($credentials);
        if (!$jwt) {
            return response()->json('Login ou senha inválidos', 401);
        }
        return response()->json([
            'token' => $jwt,
            'user' => Auth::user()
        ]);
    }

    public function logout() {
        Auth::logout();
        return response()->json(true);
    }
}
