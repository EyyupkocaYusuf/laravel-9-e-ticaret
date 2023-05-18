<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;
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
        Cart::add($product->id,$product->product_name,1,$product->price,0,['slug'=>$product->slug]);
        return redirect()->to('/')->with('success','Ürün sepete eklendi');
    }
}
