<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        return view('basket');
    }
}