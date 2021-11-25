<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        $isLoggedIn = Auth::check();
        return $isLoggedIn
            ? view('home')
            : redirect()->route('auth.login.view');
    }
}
