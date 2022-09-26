<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
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
        'method'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,"role_methods","fk_method_id", "fk_role_id", "id", "id")->withPivot("activate");
    }

    public function apps()
    {
        return $this->belongsToMany(Application::class,"application_methods","fk_method_id", "fk_app_id", "id", "id")->withPivot("activate");
    }

    public function class()
    {
        return $this->hasOne(ClassName::class, "id", "fk_class_id");
    }
}
