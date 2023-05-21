<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function index()
    {
        if(!auth()->check())
        {
            return redirect()->route('users.login')->with('warning','Ödeme işlemi için oturum açmanız  veya kayıt olmanız gerekmektedir');
        }
        else if(count(Cart::content())==0)
        {
            return redirect()->route('home')->with('warning','Ödeme işlemi için sepetinizde ürün bulunmalıdır.');
        }

        $user_details = auth()->user()->detail;
        return view('pay',compact('user_details'));
    }

    public function topay(Request $request)
    {
        $order = $request->all();
        $order['basket_id'] = session('active_basket_id');
        $order['bank'] = 'Akbank';
        $order['installment'] = 1;
        $order['status'] = 'Siparişiniz alındı';
        $order['order_amount'] = Cart::subtotal();
        Order::create($order);
        Cart::destroy();
        session()->forget('active_basket_id');

        return redirect()->route('order.index')->with('success','Siparişiniz alındı.');
    }
}
