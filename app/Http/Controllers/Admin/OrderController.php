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


        $this->validate(request(), [
            'name_surname' => 'required',
            'address' => 'required',
            'status' => 'required',
            'phone' => 'required'
        ]);


        $data = request()->only('name_surname','address','phone','mobile_phone','status');
        if ($id > 0) {
            $entry = Order::where('id', $id)->firstOrFail();
            $entry->update($data);
        }

        return redirect()
            ->route('admin.order.edit', $entry->id)
            ->with('success','Güncellendi');
    }

    public function delete($id)
    {
        Order::destroy($id);
        return redirect()
            ->route('admin.order.index')
            ->with('success','Kayıt silindi');
    }
}
