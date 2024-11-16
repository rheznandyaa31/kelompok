<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController
{
    public function login(Request $request)
    {
        return view('auth.signin');
    }

    public function login_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:6|max:10'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        return redirect()->back()->withErrors(['error' => 'Invalid Email or Password.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
