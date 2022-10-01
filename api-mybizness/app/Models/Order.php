<?php

namespace App\Models;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsToMany(Product::class,'product_orders',"fk_order_id", "fk_product_id", "id", "id")->withPivot("used", "id");
    }

    public function app()
    {
        return $this->hasOne(Application::class, 'id', "fk_app_id");
    }

    public function staff()
    {
        return $this->hasOne(User::class, 'id', "fk_staff_id");
    }

    public function payment()
    {
        return $this->hasOne(PaiementMethod::class, 'id', "fk_paiement_id");
    }
    public function voucher()
    {
        return $this->hasOne(Voucher::class, "fk_order_id", "id");
    }

}
