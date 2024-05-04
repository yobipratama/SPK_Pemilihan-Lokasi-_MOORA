<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:6'
        ]);

        if ($validated) {
            $attempt = Auth::attempt($validated);
            if ($attempt) {
                return to_route('admin.dashboard')->with('message','Login berhasil');
            }
            return back()->with('message','Email atau password salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login.index')->with('message','Logout berhasil');
    }
}
