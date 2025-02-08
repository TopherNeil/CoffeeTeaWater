<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        try {
            $form = $request->validate([
                'username' => 'required|string|max:15',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|min:8|confirmed'
            ]);

            $form['name'] = 'Chon';
            $form['password'] = Hash::make($form['password']);
            $user = User::create($form);
            Auth::login($user);
            return redirect()->intended('home');
        } catch (\Exception $e) {
            report($e);
        }
    }
}
