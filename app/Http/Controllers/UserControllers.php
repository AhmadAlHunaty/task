<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\routes\web;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;


use Illuminate\Http\Request;

class UserControllers extends Controller
{
    public function index()
    {
        return view('registration.user');
    }

    public function create()
    {
        return view('registration.createuser');
    }

    public function login()
    {
        return view('registration.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'confirmed',
                // Password::min(8)
                //     ->letters()
                //     ->mixedCase()
                //     ->numbers()
                //     ->symbols()
                //     ->uncompromised()
            ]
        ]);

        User::create(['name' => $request->name, 'email' => $request->email, 'password' => $request->password]);
        return redirect('user/create')->with('status', 'success');
    }

    public function loginPage(Request $request)
    {
        $request->validate([
            'email' => 'required|email', // Add email validation
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }

        $user = Auth::user(); // Retrieve the authenticated user
        if ($user && $user->is_active) {
            return redirect()->route('home');
        }

        Auth::logout();
        return redirect()->route('login')->with('error', 'Your account is not active. Please contact the administrator.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('user');
    }
}
