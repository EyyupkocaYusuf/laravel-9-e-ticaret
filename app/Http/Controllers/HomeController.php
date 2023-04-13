<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_detail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereRaw('top_id is null')->get();
        /*$product_slider = Product_detail::with('product')->where('show_slider',1)->take(5)->get();
        $show_featured = Product_detail::with('product')->where('show_featured',1)->take(4)->get();
        $show_bestseller = Product_detail::with('product')->where('show_bestseller',1)->take(4)->get();
        $show_discount = Product_detail::with('product')->where('show_discount',1)->take(4)->get();
        */
        $product_day= Product::select('products.*')
            ->join('product_details','product_details.product_id','products.id')
            ->where('product_details.show_opportunity_day',1)
            ->orderBy('updated_at','desc')
            ->first();
        $product_slider= Product::select('products.*')
            ->join('product_details','product_details.product_id','products.id')
            ->where('product_details.show_opportunity_day',1)
            ->orderBy('updated_at','desc')
            ->take(4)->get();
        $show_featured= Product::select('products.*')
            ->join('product_details','product_details.product_id','products.id')
            ->where('product_details.show_opportunity_day',1)
            ->orderBy('updated_at','desc')
            ->take(4)->get();
        $show_bestseller= Product::select('products.*')
            ->join('product_details','product_details.product_id','products.id')
            ->where('product_details.show_opportunity_day',1)
            ->orderBy('updated_at','desc')
            ->take(4)->get();
        $show_discount= Product::select('products.*')
            ->join('product_details','product_details.product_id','products.id')
            ->where('product_details.show_opportunity_day',1)
            ->orderBy('updated_at','desc')
            ->take(4)->get();
        return view('home',compact('categories','product_slider','product_day','show_featured','show_bestseller','show_discount'));
    }
}
