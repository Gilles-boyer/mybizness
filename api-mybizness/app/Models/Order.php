<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_at',
        'order_total',
        'fk_client_id',
        'fk_beneficiary_id',
        'fk_paiement_id'
    ];

    public function customer()
    {
        return $this->hasOne(User::class, "id", "fk_client_id");
    }
    public function beneficiary()
    {
        return $this->hasOne(User::class, "id", "fk_beneficiary_id");
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_orders',"fk_order_id", "fk_product_id", "id", "id");//->withPivot("order", "id","fk_script_mehods_id");
    }

}
