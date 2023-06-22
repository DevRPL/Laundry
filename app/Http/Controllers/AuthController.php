<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function showLoginForm()
    {
          $this->middleware('auth');
    }

    public function login()
    {
        return redirect()->route('admin.dashboard.index');
    }

    public function logout()
    {
        session()->invalidate();

        return redirect()->route('login');
    }
}
