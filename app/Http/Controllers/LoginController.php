<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $credential = $request->only('email','password');
        if (Auth::attempt($credential))
        {
             if (auth()->user()->role->name == "Admin")
             {
                 return redirect()->route('dashboard');
             }
             else if(auth()->user()->role->name == "User")
             {
                 return redirect()->route('home');
             }
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function dashboard(Request $request)
    {
        return view('master');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('login'); 
    }
}
