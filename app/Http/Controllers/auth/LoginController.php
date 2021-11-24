<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $isLoggedIn = Auth::attempt($credentials, $request->has('remember_me'));
        return $isLoggedIn ? 'yes' : back()->withErrors(['msg' => 'Invalid credentials.']);
    }
}
