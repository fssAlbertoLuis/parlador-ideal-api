<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function __constructor() {
        $this->middleware('auth')->except('create');
    }
    public function index() {
        return User::paginate(20);
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::create($validated);
        $jwt = Auth::attempt($request->only(['email', 'password']));
        if (!$jwt) {
            return response()->json('Login ou senha inválidos', 401);
        }
        return response()->json([
            'token' => $jwt,
            'user' => $user
        ]);
    }
}
