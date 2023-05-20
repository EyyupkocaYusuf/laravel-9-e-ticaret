<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;
use App\Models\User;
//use Cart;
//use Gloudemans\Shoppingcart\Cart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

class BasketController extends Controller
{
    public function index()
    {
        return view('basket');
    }

    public  function add()
    {
        $product = Product::find(\request('id'));
        $cart = Cart::add($product->id,$product->product_name,1,$product->price,0,['slug'=>$product->slug]);
        if (auth()->check()){
            $active_basket_id = session('active_basket_id');
            if(!isset($active_basket_id)) {
                $active_basket = Basket::create([
                    'user_id' => auth()->id()
                ]);
                $active_basket_id = $active_basket->id;
                session()->put('active_basket_id', $active_basket_id);
            }
            BasketProduct::updateOrCreate(
                ['basket_id'=>$active_basket_id,'product_id'=>$product->id],
                ['piece'=>$cart->qty,'amount'=>$product->price,'situation'=>'Beklemede']
            );
        }
        return redirect()->to('/sepet')->with('success','Ürün sepete eklendi');
    }

    public function remove($rowid)
    {
        if (auth()->check())
        {
            $active_basket_id = session('active_basket_id');
            $cart = Cart::get($rowid);
            BasketProduct::where('basket_id',$active_basket_id)->where('product_id',$cart->id)->delete();
        }
        Cart::remove($rowid);
        return redirect()->to('/sepet')->with('success','Ürün sepetten kaldırıldı');
    }

    public function unload()
    {
        if (auth()->check())
        {
            $active_basket_id = session('active_basket_id');

            BasketProduct::where('basket_id',$active_basket_id)->delete();
        }

        Cart::destroy();
        return redirect()->to('/')->with('success','Sepet boşaltıldı');
    }

    public function update($rowid)
    {
        if (auth()->check()) {
            $active_basket_id = session('active_basket_id');
            $cart = Cart::get($rowid);
            if (request('piece') == 0) {
                BasketProduct::where('basket_id', $active_basket_id)->where('product_id', $cart->id)->delete();
            } else {
                BasketProduct::where('basket_id', $active_basket_id)->where('product_id', $cart->id)->update(['piece' => request('piece')]);
            }
        }
        Cart::update($rowid, request('piece'));
        session()->flash('success', 'Adet bilgisi güncellendi');
        return response()->json(['success' => true]);
    }

}
