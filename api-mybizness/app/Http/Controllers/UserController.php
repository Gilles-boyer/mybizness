<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Controllers\Utility;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserModelResource;
use Illuminate\Support\Facades\Validator;


/**
 * Observable : true
 * Name : Utilisateur
 * Description : liste des functions pour la class User
 **/
class UserController extends Controller
{
    static $rulesWithoutMail = [
        "lastName"    => "required|string",
        "firstName"   => "required|string",
        "tel"        => "required|string|max:10"
    ];

    public function createValidator($request)
    {
        $rules = self::$rulesWithoutMail;
        $adapter = [
            "lastName"    => strtoupper($request->lastName),
            "firstName"   => ucfirst($request->firstName),
            "tel"        => $request->tel
        ];
        if (isset($request->email)) {
            $rules['email'] = "required|string|email";
            $adapter['email'] = $request->email;
        }
        return Validator::make(
            $adapter,
            $rules,
            Utility::$errors
        );
    }


    public function validatedValidator($validator)
    {
        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        return $validator->validated();
    }

    /**
     * Observable : true
     * Name : get Customer
     * Description : load user customer update or create
     */
    public function loadCustomer($request, $results)
    {
        try {
            $results['customer'] = $this->updateOrCreateUser($request->customer);
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Observable : true
     * Name : get Beneficiary
     * Description : load user Beneficiary update or create
     */
    public function loadBeneficiary($request, $results)
    {
        try {
            if (gettype($request->beneficiary) === "string") {
                $request->beneficiary = json_decode($request->beneficiary);
                $request->beneficiary = $this->validatedValidator(
                    $this->createValidator($request->beneficiary)
                );
            }
            $results['beneficiary'] = $this->updateOrCreateUser($request->beneficiary);
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updateOrCreateUser($validate)
    {
        $user = $this->showByPhone($validate['tel']);
        if ($user) {
            return $this->saveUser($user, $validate);
        }
        $user = new User();
        $user->fk_role_id = 1;
        return $this->saveUser($user, $validate);
    }

    /**
     * find user by phone number
     * @param string $phone
     * @return App\Models\User
     */
    public function showByPhone($phone)
    {
        return User::where("user_phone", $phone)->first();
    }

    public function saveUser($user, $validate)
    {
        $user->user_first_name = $validate['firstName'];
        $user->user_last_name = $validate['lastName'];
        $user->user_phone = $validate['tel'];
        if (isset($validate['email'])) {
            $user->user_email = $validate['email'];
        }
        $user->save();
        return new UserResource($user);
    }

    public function index()
    {
        return UserModelResource::collection(User::all());
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = (object)$request->validated();
        $user = new User();

        try {
            $newUser = $this->defineParamsUser($validated, $user);
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de création");
        }
        return Utility::responseValid("user créé",$newUser, 201);
    }

    public function defineParamsUser($params, $user)
    {
        $user->user_first_name  = $params->first_name;
        $user->user_last_name   = $params->last_name;
        $user->user_phone       = $params->phone;
        $user->user_email       = $params->email;
        $user->fk_role_id       = $params->role_id;
        $user->save();
        return  new UserModelResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $validated = (object)$request->validated();
        try{
            $user->fk_role_id       = $validated->role_id;
            $user->save();
        }catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de modification");
        }
        return Utility::responseValid("user modifiée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "erreur de suppression");
        }
        return Utility::responseValid("user supprimée");
    }

}
