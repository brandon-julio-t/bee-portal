<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (!Auth::check()) return redirect()->route('auth.login.view');
        if (Auth::user()->role === 'admin') return redirect()->route('admin.allocation');
        return view('home');
    }
}
