<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function index()
    {
        if(request()->filled('wanted'))
        {
            request()->flash();
            $wanted = request('wanted');
            $list = Product::where('product_name','like',"%$wanted%")
                ->orWhere('explanation','like',"%$wanted%")
                ->orderByDesc('id')
                ->paginate(8);
        }
        else
        {
            $list = Product::orderByDesc('id')->paginate(8);
        }
        return view('admin.product.index',compact('list'));
    }

    public function form($id = 0)
    {

    }

    public function save($id = 0)
    {

    }

    public function delete($id)
    {

    }
}
