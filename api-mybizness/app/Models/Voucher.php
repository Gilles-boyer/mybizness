<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'voucher_num',
        'voucher_validity',
        'voucher_message',
        'voucher_color',
        'voucher_font',
        'fk_order_id',
        'fk_image_id',
        'fk_font_id',
        'fk_color_id',
        'fk_shipping_id'
    ];

    public function font()
    {
        return $this->hasOne(Font::class, "id", "fk_font_id");
    }
    public function order()
    {
        return $this->hasOne(Order::class, "id", "fk_order_id");
    }
    public function image()
    {
        return $this->hasOne(Image::class, "id", "fk_image_id");
    }
    public function color()
    {
        return $this->hasOne(Color::class, "id", "fk_color_id");
    }
}
