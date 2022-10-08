<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Resources\RoleResource;
use App\Http\Requests\RoleStoreRequest;


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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $role = Role::create([
            "role_name"         => $request->name,
            "role_description"  => $request->description
        ]);

        return Utility::responseValid(
            "role created",
            new RoleResource($role),
            201
        );
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return Utility::responseValid("role id:".$role->id, new RoleResource($role));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(RoleStoreRequest $request, Role $role)
    {
        $role->role_name = $request->name;
        $role->role_description = $request->description;
        $role->save();

        return Utility::responseValid("role updated", new RoleResource($role));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
