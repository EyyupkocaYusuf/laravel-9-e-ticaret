<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bekleyen_siparisler = Order::where('status','Siparişiniz alındı')->count();
        return view('admin.home',compact('bekleyen_siparisler'));
    }
}
