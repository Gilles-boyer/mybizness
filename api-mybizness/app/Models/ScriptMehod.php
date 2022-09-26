<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScriptMehod extends Model
{
    use HasFactory;

            /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fk_script_id',
        'fk_method_id ',
        'fk_script_mehods_id',
        'order',
    ];

    public function subScripts()
    {
        return $this->hasMany(ScriptMehod::class, "fk_script_mehods_id", "id");
    }


}
