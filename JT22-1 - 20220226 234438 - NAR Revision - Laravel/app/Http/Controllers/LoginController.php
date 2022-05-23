<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function loginValidation(Request $req)
    {
        $req->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );

        $credentials = [
            'email' => $req->email,
            'password' => $req->password
        ];

        if (Auth::attempt($credentials, $req->remember)) {
            if (Auth::user()->role == 'admin')
                return redirect('/allocation');
            else {
                return redirect('/dashboard');
            }
        }

        // Session::put(['error_credentials' => '']);
        return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function index()
    {
        return view('login');
    }
}
