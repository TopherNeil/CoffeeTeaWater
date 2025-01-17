<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function showLoginForm() 
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required'
        ]);

        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        try {
            if(Auth::attempt([$loginField => $request->input('login'), 'password' => $request->input('password')]))
            {
                $request->session()->regenerate();
                return redirect()->intended('home');
            }

            return redirect('login')
                ->withInput($request->only('login'))
                ->with('message', 'Incorrect ' . $loginField . ' or password.');

        } catch (\Exception $e) {
            report($e);

            return response()->json(['message' => $e->getMessage()]);
        }   
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public static function clearMessage() 
    {
        Session::remove('message');
    }
}
