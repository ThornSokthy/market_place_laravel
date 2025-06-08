<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $field = $request->validate([
           'firstname' => ['required', 'max:255'],
           'lastname' => ['required', 'max:255'],
           'phone' => ['required', 'min:9', 'max:15', 'unique:users'],
           'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'first_name' => $field['firstname'],
            'last_name' => $field['lastname'],
            'phone' => $field['phone'],
            'password' => Hash::make($field['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home');

    }

    public function login(Request $request) {
        $field = $request->validate([
            'phone' => ['required', 'min:9', 'max:15'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($field, $request->remember)) {
            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our records.',
            ]);
        }

    }

}
