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

        $aylara_gore_satislar = DB::select("
            SELECT
              DATE_FORMAT(si.created_at, '%Y-%m') ay, sum(su.piece) adet
            FROM orders si
            INNER JOIN basket s on s.id = si.basket_id
            INNER JOIN basket_product su on s.id=su.basket_id
            GROUP BY DATE_FORMAT(si.created_at, '%Y-%m')
            ORDER BY DATE_FORMAT(si.created_at, '%Y-%m')
        ");
        return view('admin.home',compact('cok_satan_urunler','aylara_gore_satislar'));
    }
}
