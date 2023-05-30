<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function form($id = 0)
    {
        $entry = new Category();
        if($id > 0)
        {
            $entry = Category::find($id);
        }
        $kategoriler = Category::all();
        return view('admin.kategori.form',compact('entry','kategoriler'));
    }

    public function save($id = 0)
    {
        $this->validate(request(), [
            'category_name' => 'required',
        ]);
        $data = request()->only('category_name','slug','top_id');
        if ($id > 0) {
            $entry = Category::where('id', $id)->firstOrFail();
            $entry->update($data);
        } else {
            $entry = Category::create($data);
        }

        return redirect()
            ->route('admin.category.edit', $entry->id)
            ->with('mesaj', ($id > 0 ? 'Güncellendi' : 'Kaydedildi'))
            ->with('mesaj_tur', 'success');
    }

}
