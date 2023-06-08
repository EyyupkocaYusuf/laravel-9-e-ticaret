<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use function PHPUnit\TestFixture\func;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with('basket')->whereHas('basket', function($query) {
            $query->where('user_id', auth()->id());
        })->orderByDesc('created_at')->get();
        return view('order',compact('orders'));
    }

    public function details($id)
    {
        $order = Order::with('basket.basket_products.product')->whereHas('basket', function($query) {
            $query->where('user_id', auth()->id());
        })->where('id',$id)->firstOrFail();
        return view('details',compact('order'));
    }
}
