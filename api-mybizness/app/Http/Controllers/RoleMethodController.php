<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleMethod;
use App\Http\Requests\RoleMethodRequest;
use Illuminate\Database\Eloquent\Collection;


class RoleMethodController extends Controller
{

    /**
     * Store a newly created RoleMethod in storage.
     *
     * @param int $fk_role_id
     * @param int $fk_method_id
     * @param string $role_name
     * @return App\Models\RoleMethod
     */
    public static function store(int $fk_role_id, int $fk_method_id, string $role_name = ""): RoleMethod
    {
        $roleMethod = new RoleMethod();

        $roleMethod->fk_role_id = $fk_role_id;
        $roleMethod->fk_method_id = $fk_method_id;
        if ($role_name == "admin") {
            $roleMethod->activate = true;
        }

        $roleMethod->save();

        return $roleMethod;
    }

    /**
     * check if relation exist between role and method. This function create
     * and update for refresh list ACL by role user
     *
     * @param App\Models\Method $method
     * @return void
     */
    public static function processingRelationMethodRole($method): void
    {
        if ($method) {
            $roleMethods = RoleMethod::where("fk_method_id", $method->id)->get();
            $checkArray = ((array)$roleMethods)["\x00*\x00items"];

            if ($roleMethods) {
                if ($checkArray == []) {
                    self::createRelationBaseForMethodRoles($method->id);
                } elseif (count($checkArray) > 0) {
                    self::updateRelationBaseForMethodRoles($roleMethods);
                }
            }
        }
    }

    /**
     * create all object RoleMethod for define relation between Role and Method
     *
     * @param int $method_id
     * @return void
     */
    public static function createRelationBaseForMethodRoles(int $method_id): void
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            self::store($role->id, $method_id, $role->role_name);
        }
    }

    /**
     * create all object RoleMethod for update relation between Role and Method
     *
     * @param Illuminate\Database\Eloquent\Collection $roleMethods
     * @return void
     */
    public static function  updateRelationBaseForMethodRoles(Collection $roleMethods): void
    {
        $roles = Role::all();

        foreach ($roles as $role) {
            foreach ($roleMethods as $roleMethod) {
                if (
                    !RoleMethod::where(
                        [
                            "fk_method_id" => $roleMethod->fk_method_id,
                            "fk_role_id" => $role->id
                        ]
                    )->first()
                ) {
                    self::store($role->id, $roleMethod->fk_method_id, $role->role_name);
                }
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(RoleMethodRequest $request)
    {
        $roleMethod = RoleMethod::where(
            [
                "fk_role_id" => $request->role_id,
                "fk_method_id" => $request->method_id
            ]
        )->first();

        $roleMethod->activate = !$roleMethod->activate;

        if ($roleMethod->save()) {
            return Utility::responseValid("les droits ont été mis à jour");
        } else {
            return Utility::responseError([], "un problème est survenu lors de la mis à jour du droit utilisateur");
        }
    }
}
