<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        $user = \App\Models\User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors([
                'login_error' => 'Email tidak terdaftar dalam sistem'
            ])->withInput();
        }
        
        if (Auth::attempt($infologin)) {
            return redirect('/dashboard')->with('status', 'Login berhasil!');
        } else {
            return back()->withErrors([
                'login_error' => 'Password yang dimasukkan tidak sesuai'
            ])->withInput();
        }
    }
}
