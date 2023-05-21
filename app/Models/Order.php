<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable = ['basket_id', 'order_amount','name_surname','phone','mobile_phone','address', 'installment', 'bank', 'status'];

    public function basket()
    {
        return $this->belongsTo(Basket::class, 'basket_id','id');
    }
}
