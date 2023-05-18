<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Detail extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'user_details';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
