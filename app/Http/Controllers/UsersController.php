<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\UsersRegisterMail;
use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\User;
use App\Models\User_Detail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logOut');
    }
    public function login()
    {
        return view('users.login');
    }

    public  function loginPost(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email, 'password' => $request->password],$request->has('benihatirla')))
        {
            toastr()->success('Giriş Yapıldı', 'Success');
            $active_basket_id = Basket::firstOrCreate(['user_id'=>auth()->id()])->id;
            session()->put('active_basket_id',$active_basket_id);
            if(Cart::count() > 0)
            {
                foreach (Cart::content() as $cart)
                {
                    BasketProduct::updateOrCreate(
                        ['basket_id'=>$active_basket_id,'product_id'=>$cart->id],
                        ['piece'=>$cart->qty,'amount'=>$cart->price,'situation'=>'Beklemede']
                    );

                }
            }
            Cart::destroy();
            $basketProducts =BasketProduct::where('basket_id',$active_basket_id)->get();
            foreach ($basketProducts as $basketProduct)
            {
                Cart::add($basketProduct->product->id,$basketProduct->product->product_name,$basketProduct->piece,$basketProduct->amount,0,['slug'=>$basketProduct->product->slug]);
            }
            return redirect()->intended('/');
        }
        return redirect()->route('users.login')->withErrors('Mail veya Şifre hatalı');
    }

    public  function logOut()
    {
        Auth::logout();
        toastr()->success('Çıkış Yapıldı', 'Success');
        return redirect()->route('users.login');
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
        $user->detail()->save(new User_Detail());
        Mail::to(request('email'))->send(new UsersRegisterMail($user));
        if($user->activation_key == null and $user->is_active==1)
        {
            auth()->login($user);
        }

        return redirect()->route('home')->with('warning','Alışverişe devam etmek için lütfen aktivasyon işlemini tamamlayın.');
    }

    public function activation($key)
    {
        $user = User::where('activation_key',$key)->first();
        if(!is_null($user))
        {
            $user->activation_key=null;
            $user->is_active=1;
            $user->save();
            auth()->login($user);
            return redirect()->to('/')->with('success','Kaydınız başarılı bir şekilde aktifleştirildi');
        }
        else{
            return redirect()->to('/')->with('warning','Kaydınız  aktifleştirilemedi');
        }
    }


}
