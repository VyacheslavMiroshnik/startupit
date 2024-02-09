<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'price',
        'img'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class,'carts','product_id','user_id')->withPivot('count');
    }

}
