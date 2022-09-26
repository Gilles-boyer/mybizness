<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'product_description',
        'product_img',
        'product_price',
        'product_online',
        'fk_category_id',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, "id", "fk_category_id");
    }


}
