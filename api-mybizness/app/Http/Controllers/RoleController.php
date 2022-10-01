<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;


class RoleController extends Controller
{
    /**
     * Observable : true
     * Name : Role with name
     * Description : Display a specific Role with name of role
     * @param  string  $name of role
     * @return \Illuminate\Http\Response
     */
    public function showByName(string $name)
    {
        $role = Role::where("role_name", $name)->first();

        return $role;
    }

    /**
     * Observable : true
     * Name : List Role
     * Description : Display a listing of the resource Roles
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Utility::responseValid(
            "liste des Roles",
            RoleResource::collection(
                Role::all()
            )
        );
    }
}
