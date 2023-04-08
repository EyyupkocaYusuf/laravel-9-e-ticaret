<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return view('order');
    }

    public function details($id)
    {
        return view('details');
    }
}
