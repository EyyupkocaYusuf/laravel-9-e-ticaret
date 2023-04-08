<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function login()
    {
        return view('users.login');
    }

    public function register()
    {
        return view('users.register');
    }
}
