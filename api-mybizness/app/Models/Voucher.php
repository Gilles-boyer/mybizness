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
        'fk_theme_id',
        'fk_shipping_id'
    ];

    public function theme()
    {
        return $this->hasOne(Theme::class, "id", "fk_theme_id");
    }
    public function order()
    {
        return $this->hasOne(Order::class, "id", "fk_order_id");
    }
}
