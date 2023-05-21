<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Basket extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table="basket";
    protected  $guarded =[];
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    public function order_()
    {
        return $this->hasOne(Order::class);
    }

    public function basket_products()
    {
        return  $this->hasMany(BasketProduct::class);
    }
    public static function aktif_sepet_id()
    {
        $active_basket = DB::table('basket as s')
            ->leftJoin('orders as si', 'si.basket_id', '=', 's.id')
            ->where('s.user_id', auth()->id())
            ->whereRaw('si.id is null')
            ->orderByDesc('s.created_at')
            ->select('s.id')
            ->first();

        if (!is_null($active_basket)) return $active_basket->id;
    }

    public function basket_product_piece()
    {
        return DB::table('basket_product')->where('basket_id', $this->id)->sum('piece');
    }
}
