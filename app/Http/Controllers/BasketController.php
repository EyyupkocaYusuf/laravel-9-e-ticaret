<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        return view('basket');
    }
    public  function add()
    {
        $product = Product::find(\request('id'));
        Cart::add($product->id,$product->product_name,$product->price);
        return redirect()->route('basket.index')->with('mesaj','Ürün sepete eklendi.');
    }
}
