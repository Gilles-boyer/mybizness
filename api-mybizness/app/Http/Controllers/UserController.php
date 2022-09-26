<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Utility;
use App\Http\Requests\UserClientRequest;
use Illuminate\Support\Facades\Validator;


/**
 * Observable : true
 * Name : Utilisateur
 * Description : liste des functions pour la class User
 **/
class UserController extends Controller
{

    static $rules = [
        "last_name"   => "required|string",
        "first_name" => "required|string",
        "email"      => "required|email",
        "phone"      => "required|string"
    ];

    private RoleController $role;

    public function __construct()
    {
        $this->role = new RoleController();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserClientRequest  $request
     * @param  string  $type
     * @return method verifyDataUser
     */
    public function store(UserClientRequest $request, string $type, bool $response = true)
    {
        if ($type == "admin" || $type == "staff") {
            return Utility::responseError("droit admin requis");
        }

        $role = $this->verifyRoleUser($type);

        if (!$role) {
            return Utility::responseError("le role n'existe pas");
        }

        $request->type = $type;

        return $this->verifyDataUser($request, $role, $response);
    }


    /**
     * check role by name and return object role
     *
     * @param  string  $type
     * @return Role $role || false
     */
    public function verifyRoleUser(string $type)
    {
        if ($type == "beneficiary") {
            $type = "client";
        }

        $role = $this->role->showByName($type);

        if ($role) {
            return $role;
        }
        return false;
    }

    /**
     * valid data request and format data
     *
     * @param  UserClientRequest  $request
     * @param  Role $role
     * @return function storeDataUser
     */
    public function verifyDataUser(UserClientRequest $request, Role $role, bool $response = true)
    {
        $validator = Validator::make(
            $request->all(),
            $request->rules(),
            Utility::$errors
        );

        if ($validator->fails()) {
            return Utility::responseError(
                $validator->errors(),
            );
        }
        $request = $this->formatRequestUser($request);

        return $this->storeDataUser($request, $role, $response);
    }

    /**
     * format data user (first_name, last_name, email)
     *
     * @param  UserClientRequest  $request
     * @return UserClientRequest $request
     */
    public function formatRequestUser(UserClientRequest $request)
    {
        $request->first_name = ucfirst(strtolower($request->first_name));
        $request->last_name  = strtoupper($request->last_name);
        if ($request->email) {
            $request->email = strtolower($request->email);
        }

        return $request;
    }

    /**
     * store or update user
     *
     * @param  UserClientRequest  $request
     * @param  Role  $role
     * @return Response new user
     */
    public function storeDataUser(UserClientRequest $request, Role $role, bool $response)
    {
        $user = false;
        if (isset($request->email)) {
            $user = $this->findUserByEmail($request->email);
        } else {
            $user = $this->findUserByPhone($request->phone);
        }

        if (!$user) {
            $user = new User();
        }

        $user = $this->updateFieldUser($user, $request, $role);

        $user->save();

        if ($response) {
            return Utility::responseValid("User created", $user);
        } else {
            return $user;
        }
    }

    /**
     * search user by email
     *
     * @param  string $email
     * @return User
     */
    private function findUserByEmail(string $email)
    {
        return User::where("user_email", $email)->first();
    }

   protected static function validateUserData(array $object)
    {
        foreach ($object as $key=>$value)
        {
            if($key == "firstName"){
                $object['first_name'] = $value;
            }
            if($key == "lastName") {
                $object['last_name'] = $value;
            }
            if($key == "tel") {
                $object["phone"] = $value;
            }
        }
        $validator = Validator::make(
            $object,
            self::$rules,
            Utility::$errors
        );
        return $validator;
    }

    public static function getCustumer($object)
    {
        $validate = self::validateUserData((array)$object);
        if ($validate->fails()) {
            return Utility::responseError(
                $validate->errors(),
                "echec validation"
            );
        }
        $validate =(array)$validate->validated();

        $user = User::where("user_email", $validate['email'])->first();

        if(isset($user->id))
        {
            return $user;
        }

        return self::storeNewUser($validate);
    }

    protected static function storeNewUser($data)
    {
        $user = new User();
        $user->user_first_name = $data['first_name'];
        $user->user_last_name = $data['last_name'];
        $user->user_email = $data['email'];
        $user->user_phone  = $data['phone'];
        $user->fk_role_id = 1;

        $user->save();

        return $user;
    }

    /**
     * search user by phone
     *
     * @param  string $phone
     * @return User
     */
    private function findUserByPhone(string $phone)
    {
        return User::where("user_phone", $phone)->first();
    }


    /**
     * configure object user for storage
     *
     * @param  User $user
     * @param  UserClientRequest $request
     * @return Role $role
     */
    private function updateFieldUser(User $user, UserClientRequest $request, Role $role)
    {
        $user->user_first_name = $request->first_name;
        $user->user_last_name  = $request->last_name;
        $user->user_phone      = $request->phone;
        if (isset($request->email)) {
            $user->user_email  = $request->email;
        }
        $user->fk_role_id      = $role->id;

        return $user;
    }
}
