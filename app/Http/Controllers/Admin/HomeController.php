<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $cok_satan_urunler = DB::select("
            SELECT u.product_name, SUM(su.piece) adet
            FROM orders si
            INNER JOIN basket s ON s.id = si.basket_id
            INNER JOIN basket_product su ON s.id = su.basket_id
            INNER JOIN products u ON u.id = su.product_id
            GROUP BY u.product_name
            ORDER BY SUM(su.piece) DESC
        ");
       /* $cok_satan_urunler = Order::select(DB::raw('products.product_name, SUM(basket_product.piece) as piece'))
            ->join('basket', 'id', 'orders.basket_id')
            ->join('basket_product', 'basket_id', 'basket_product.basket_id')
            ->join('products', 'product.id', 'basket_product.product_id')
            ->groupBy('product_name')
            ->orderBy(DB::raw('SUM(basket_product.piece)'), 'desc')
            ->get();*/
        return view('admin.home',compact('cok_satan_urunler'));
    }
}
