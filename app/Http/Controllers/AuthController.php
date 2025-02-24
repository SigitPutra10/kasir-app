<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success','login berhasil!');
        }

        return redirect()->back()->with('error','password atau email invalid!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','logout berhasil!');
    }
}
