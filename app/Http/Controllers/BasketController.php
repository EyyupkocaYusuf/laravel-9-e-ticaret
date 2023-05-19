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
        return redirect()->to('/sepet')->with('success','Ürün sepete eklendi');
    }
    public function remove($rowid)
    {
        Cart::remove($rowid);
        return redirect()->to('/sepet')->with('success','Ürün sepetten kaldırıldı');
    }
    public function unload()
    {
        Cart::destroy();
        return redirect()->to('/')->with('success','Sepet boşaltıldı');
    }
}
