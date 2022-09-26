<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    public function methods()
    {
        return $this->belongsToMany(Method::class,'script_mehods',"fk_script_id", "fk_method_id", "id", "id")->withPivot("order", "id","fk_script_mehods_id");
    }
}
