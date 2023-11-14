<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuthManager extends Controller
{
    function login()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('login');
    }
    function register()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('register');
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'))->with("success", "Logged in!!");
        }
        return redirect(route('login'))->with("error", "Invalid Credentials!!");
    }


    function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        if (!$user) {
            return redirect(route('register'))->with("error", "Registration Failed!!");
        }
        return redirect(route('login'))->with("success", "Registration Successfull!!");
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role_as == '1') {
            return redirect(route('admin.dashboard'))->with('status', 'Welcome to Dashboard');
        } else {
            return redirect(route('home'))->with('status', 'Logged In!!');
        }
    }
}
