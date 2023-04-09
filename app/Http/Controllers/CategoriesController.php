<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index($slug_categoryname)
    {
        $category = Category::whereSlug($slug_categoryname)->firstOrFail();
        $under_categories = Category::whereTop_id($category->id)->get();
        return view('category',compact('category','under_categories'));

    }
}
