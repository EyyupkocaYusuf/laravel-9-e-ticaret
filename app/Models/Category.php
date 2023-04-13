<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name','slug'];
    use SoftDeletes;
    public function products()
    {
        return $this->belongsToMany(Product::class,'category_product','category_id','product_id');
    }
}
