<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->filled('aranan'))
        {
            request()->flush();
            $aranan = request('aranan');
            $list = Category::where('category_name','like', "%$aranan%")
                ->orderByDesc('created_at')
                ->paginate(8)
                ->appends('aranan',$aranan);
        }else{
            $list = Category::orderByDesc('created_at')->paginate(8);
        }

        return view('admin.kategori.index',compact('list'));
    }
}
