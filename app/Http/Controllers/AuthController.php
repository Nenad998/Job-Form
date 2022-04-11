<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(AuthRequest $request)
    {
        $user = User::create([
            'firstName'=> $request->firstName,
            'lastName'=> $request->lastName,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'phoneNumber'=> $request->phoneNumber,
            'birth'=> $request->birth
        ])->save();

        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
         if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
