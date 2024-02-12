<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'price',
        'img',
        'discount'
    ];
    /**
     * Создаем связь многии ко многим
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(
            User::class,
            'carts',
            'product_id',
            'user_id'
        )->withPivot('count');
    }
}
