<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index($slug_productname)
    {
        $product=Product::whereSlug($slug_productname)->firstOrFail();
        $categories = $product->categories()->distinct()->get() ;
        return view('product',compact('product','categories'));
    }
    public function Search()
    {
        $wanted = request()->input('wanted');
        $products =Product::where('product_name','like','%'.$wanted.'%')
            ->orWhere('explanation','like','%'.$wanted.'%')
            ->paginate(5);
        //paginate tam çalışmıyor bulamadım ama görsel bir hata
        request()->flash();
        return view('call',compact('products'));
    }

}
