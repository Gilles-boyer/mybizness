<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Controllers\Utility;
use Illuminate\Support\Facades\Validator;


/**
 * Observable : true
 * Name : Utilisateur
 * Description : liste des functions pour la class User
 **/
class UserController extends Controller
{

    static $rulesCustomer = [
        "user_last_name"    => "required|string",
        "user_first_name"   => "required|string",
        "user_email"        => "required|email",
        "user_phone"        => "required|string"
    ];

    static $rulesBeneficiary = [
        "user_last_name"    => "required|string",
        "user_first_name"   => "required|string",
        "user_phone"        => "required|string"
    ];

    /**
     * Observable : true
     * Name : get Customer
     * Description : load user customer update or create
     */
    public function loadCustomer($request, $results)
    {
        try {
            $results['customer'] = $this->loadUser(json_decode($request->customer), "customer");
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
            $results['beneficiary'] = $this->loadUser(json_decode($request->beneficiary),"beneficiary");
            return $results;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function createValidatorCustomer($request)
    {
        return Validator::make(
            [
                "user_last_name"    => strtoupper($request->lastName),
                "user_first_name"   => ucfirst($request->firstName),
                "user_email"        => $request->email,
                "user_phone"        => $request->tel
            ],
            UserController::$rulesCustomer,
            Utility::$errors
        );
    }

    public function createValidatorBeneficiary($request)
    {
        return Validator::make(
            [
                "user_last_name"    => strtoupper($request->lastName),
                "user_first_name"   => ucfirst($request->firstName),
                "user_phone"        => $request->tel
            ],
            UserController::$rulesBeneficiary,
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

    public function loadUser($request, $typeUser)
    {
        if($typeUser == "customer" || $request->email) {
            return $this->updateOrCreateUser(
                $this->validatedValidator($this->createValidatorCustomer($request))
            );
        } else {
            return $this->updateOrCreateUser(
                $this->validatedValidator($this->createValidatorBeneficiary($request))
            );
        }
    }

    public function updateOrCreateUser($validate)
    {
        $user = $this->showByPhone($validate['user_phone']);
        if ($user) {
            return $this->saveUser($user, $validate);
        }
        $user = new User();
        $user->fk_role_id = 1;
        return $this->saveUser($user, $validate);
    }

    public function showByPhone($phone)
    {
        return User::where("user_phone", $phone)->first();
    }

    public function saveUser($user, $validate)
    {
        $user->user_first_name = $validate['user_first_name'];
        $user->user_last_name = $validate['user_last_name'];
        $user->user_phone = $validate['user_phone'];
        if(isset($validate['user_email'])){
            $user->user_email = $validate['user_email'];
        }
        $user->save();

        return $user;
    }
}
