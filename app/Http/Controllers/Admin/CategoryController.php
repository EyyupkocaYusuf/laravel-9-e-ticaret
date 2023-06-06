<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use function Webmozart\Assert\Tests\StaticAnalysis\resource;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->filled('aranan') || request()->filled('top_id'))
        {
            request()->flash();
            $aranan = request('aranan');
            $top_id = request('top_id');
            $list = Category::with('top_category')
                ->where('category_name','like', "%$aranan%")
                ->where('top_id',$top_id)
                ->orderByDesc('id')
                ->paginate(2)
                ->appends(['aranan'=>$aranan,'top_id'=>$top_id]);
        }else{
            request()->flush();
            $list = Category::with('top_category')->orderByDesc('id')->paginate(8);
        }

        $main_categories= Category::whereRaw('top_id is null')->get();
        return view('admin.kategori.index',compact('list','main_categories'));
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

        $data = request()->only('category_name','slug','top_id');
        if(!request()->filled('slug'))
        {
            $data['slug']= str::slug(request('category_name'));
            request()->merge(['slug'=>$data['slug']]);
        }

        $this->validate(request(), [
            'category_name' => 'required',
            'slug'=>(request('original_slug') != request('slug') ?'unique:categories,slug':'')
        ]);

        if ($id > 0) {
            $entry = Category::where('id', $id)->firstOrFail();
            $entry->update($data);
        } else {
            $entry = Category::create($data);
        }

        return redirect()
            ->route('admin.category.edit', $entry->id)
            ->with('success',($id>0?'Güncellendi':'kaydedildi'));
    }
    public function delete($id)
    {
         $category= Category::find($id);
         $category->products()->detach();
         Category::destroy($id);
        return redirect()
            ->route('admin.category.index')
            ->with('success','Kayıt silindi');
    }


}
