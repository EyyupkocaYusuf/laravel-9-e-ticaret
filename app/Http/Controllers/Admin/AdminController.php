<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            $validate = Validator::make($request->post(),$rules);
            if($validate->fails())
            {
                return redirect()->route('users.register')->withErrors($validate)->withInput();
            }
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'is_admin'=> 1,
            ];
            if(Auth::guard('administrator')->attempt($credentials,$request->has('meremember')))
            {
                return redirect()->route('admin.home')->with('success','Giriş Başarılı');
            }
            else{
                return back()->withInput()->withErrors(['email' => 'Giriş Hatalı!']);
            }
        }
        return view('admin.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('administrator')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        toastr()->success('Çıkış Yapıldı', 'Success');
        return redirect()->route('admin.login');
    }
}
