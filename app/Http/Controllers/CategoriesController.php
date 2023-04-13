<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index($slug_categoryname)
    {
        $category = Category::whereSlug($slug_categoryname)->firstOrFail();
        $under_categories = Category::whereTop_id($category->id)->get();

        $order = request('order');
        if ($order == 'bestseller'){
            $products = $category->products()
                ->distinct()
                ->join('product_details','product_details.product_id','products.id')
                ->orderBy('product_details.show_bestseller','desc')
                ->paginate(2);
        }else if($order == 'new'){
            $products = $category->products()->distinct()->orderBy('updated_at')->paginate(2);
        }else{
            $products = $category->products()->distinct()->paginate(2);
        }

        return view('category',compact('category','under_categories','products'));

    }
}
