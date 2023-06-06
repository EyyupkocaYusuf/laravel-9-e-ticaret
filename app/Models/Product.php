<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table="products";
    protected $guarded=[];
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_product','product_id','category_id');
    }
    public function details()
    {
        return $this->hasOne(Product_detail::class,'product_id','id')->withDefault();
    }
}
