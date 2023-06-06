<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $entry= new Product;
        $urun_kategoriler = [];
        if($id>0)
        {
            $entry=Product::find($id);
            $urun_kategoriler = $entry->categories()->pluck('category_id')->all();
        }
        $kategoriler = Category::all();
        return view('admin.product.form',compact('entry','kategoriler','urun_kategoriler'));
    }

    public function save($id = 0)
    {

        $data = request()->only('product_name','slug','explanation','price');
        if(!request()->filled('slug'))
        {
            $data['slug']= Str::slug(request('product_name'));
            request()->merge(['slug'=>$data['slug']]);
        }

        $this->validate(request(), [
            'product_name' => 'required',
            'price' => 'required',
            'slug'=>(request('slug') != request('slug') ?'unique:product,slug' : '')
        ]);

        $data_detail = request()->only('show_slider', 'show_opportunity_day', 'show_featured', 'show_bestseller', 'show_discount');

        $kategoriler = request('kategoriler');

        if ($id > 0) {
            $entry = Product::where('id', $id)->firstOrFail();
            $entry->update($data);
            $entry->details()->update($data_detail);
            $entry->categories()->sync($kategoriler);
        } else {
            $entry = Product::create($data);
            $entry->details()->create($data_detail);
            $entry->categories()->attach($kategoriler);
        }

        return redirect()
            ->route('admin.product.edit', $entry->id)
            ->with('success',($id>0?'Güncellendi':'kaydedildi'));
    }

    public function delete($id)
    {
        $product =  Product::find($id);
        $product->categories()->detach(); // detach fonksiyonu many to many iliskiside kullanılır.
        $product->delete();
        return redirect()
            ->route('admin.product.index')
            ->with('success','Kayıt silindi');
    }
}
