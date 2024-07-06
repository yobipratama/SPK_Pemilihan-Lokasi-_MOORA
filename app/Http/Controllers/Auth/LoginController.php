<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:6'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->with('message', 'Email atau password salah');
        }

        $user = Auth::user();
        if ($user->role->name === 'admin') {
            return to_route('admin.dashboard')->with('message', 'Login berhasil');
        }

        return to_route('user.dashboard')->with('message', 'Login berhasil');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login.index')->with('message','Logout berhasil');
    }
}
