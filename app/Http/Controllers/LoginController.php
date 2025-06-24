<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController
{
   public function showLoginForm()
{
    return view('auth.login'); // Blade file at resources/views/auth/login.blade.php
}

public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/files'); // or home
    }

    return back()->withErrors(['username' => 'Invalid credentials']);
}
}
