<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password'); // Sesuaikan dengan field pada form login
    
        // if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        // }
    
        return back()->withErrors(['username' => 'Username or password incorrect.']);
    }
    
}
