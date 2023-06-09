<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name_surname','email','password','activation_key','is_active','is_admin'];
    protected $hidden = ['password','activation_key'];

    public function detail()
    {
        return $this->hasOne(User_Detail::class)->withDefault();
    }
}
