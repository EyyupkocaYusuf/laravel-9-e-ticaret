<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        if(request()->filled('wanted'))
        {
            request()->flash();
            $wanted = request('wanted');
            $list = Order::with('basket.User')->where('name_surname','like',"%$wanted%")
                ->orWhere('id',$wanted)
                ->orderByDesc('id')
                ->paginate(8);
        }
        else
        {
            request()->flush();
            $list = Order::orderByDesc('id')->paginate(8);
        }
        return view('admin.order.index',compact('list'));
    }

    public function form($id = 0)
    {

        if($id>0)
        {
            $entry=Order::with('basket.basket_products.product')->find($id);

        }
        return view('admin.order.form',compact('entry'));
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

        if (request()->hasFile('product_image')) {
            $this->validate(request(), [
                'product_image' => 'image|mimes:jpg,png,jpeg,gif|max:2048'
            ]);

            $product_image = request()->file('product_image');
            //$product_image = request()->product_image;

            $dosyaadi = $entry->id . "-" . time() . "." . $product_image->extension();
            //$dosyaadi = $product_image->getClientOriginalName();
            //$dosyaadi = $product_image->hashName();

            if ($product_image->isValid()) {
                File::delete('uploads/urunler/' . $entry->details->product_image);

                $product_image->move('uploads/urunler', $dosyaadi);

                Product_detail::updateOrCreate(
                    ['product_id' => $entry->id],
                    ['product_image' => $dosyaadi]
                );
            }
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
