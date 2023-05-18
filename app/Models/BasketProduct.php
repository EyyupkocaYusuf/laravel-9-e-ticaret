<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasketProduct extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table="basket_product";
    protected  $guarded =[];
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
