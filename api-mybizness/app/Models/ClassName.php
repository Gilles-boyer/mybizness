<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
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
        'class_patch'
    ];

    /**
     * Get the method that owns the class.
     */
    public function methods()
    {
        return $this->hasMany(Method::class, 'fk_class_id', 'id');
    }
}
