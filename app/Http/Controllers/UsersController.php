<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\UsersRegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    public function registerpost(Request $request)
    {
        $rules = [
            'name_surname' => 'required|min:3|max:60',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6|max:15',
        ];
        $validate = Validator::make($request->post(),$rules);
        if($validate->fails())
        {
            return redirect()->route('users.register')->withErrors($validate)->withInput();
        }
        $user = User::create([
            'name_surname' => request('name_surname'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'activation_key' => Str::random(60),
            'is_active'=> 0
        ]);

        Mail::to(request('email'))->send(new UsersRegisterMail($user));

       auth()->login($user);
        return redirect()->route('home')->with('success','Oturum Açıldı.');
    }
}
