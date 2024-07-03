<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = User::find(Auth::user()->id);
            if ($user->hasRole('Dokter')) {
                return redirect()->intended(route('dashboard'));
            } elseif($user->hasRole('Rekam Medis')) {
                return redirect()->intended(route('dashboard'));
            } elseif($user->hasRole('Bidan')) {
                return redirect()->intended(route('dashboard'));
            } elseif($user->hasRole('Perawat')) {
                return redirect()->intended(route('dashboard'));
            } elseif($user->hasRole('Dokter Gigi')) {
                return redirect()->intended(route('dashboard'));
            } elseif($user->hasRole('Admin')) {
                return redirect()->intended(route('dashboard'));
            } elseif($user->hasRole('Kepala Klinik')) {
                return redirect()->intended(route('dashboard'));
            } elseif($user->hasRole('Apoteker')) {
                return redirect()->intended(route('dashboard'));
            }
            else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda tidak memiliki hak akses yang cukup.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
