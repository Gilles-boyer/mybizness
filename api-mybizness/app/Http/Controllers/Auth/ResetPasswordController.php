<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Jobs\LinkResetMail;
use App\Http\Controllers\Utility;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\EmailTokenPasswordRequest;
use App\Http\Requests\TokenResetPasswordRequest;

class ResetPasswordController extends Controller
{
    public $password_reset;

   public function __construct()
   {
     $this->password_reset = DB::table('password_resets');
   }

    protected function sendResetLinkPassword(ResetPasswordRequest $request){
        $request = (object) $request->validated();
        $email = $request->email;
        try {
            $this->isUniqueReset($email);
            $this->createNewReset($email);
            $this->sendMailResetPassword($this->getResetByMail($email));

            return Utility::responseValid("mail envoyé");

        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "echec creation reset password");
        }
    }

    protected function getResetByMail($email)
    {
        return ($this->password_reset->where('email', $email)->get())[0];
    }

    protected function getResetByToken($token)
    {
        return ($this->password_reset->where('token', $token)->get())[0];
    }

    protected function isUniqueReset($email)
    {
        $resets = $this->password_reset->where("email", $email)->get();
        if(count($resets) > 0){
            foreach ($resets as $reset)
            {
                $this->deleteReset($reset->email);
            }
        }
    }

    protected function deleteReset($email)
    {
        $this->password_reset->where('email', $email)->delete();
    }

    protected function sendMailResetPassword($reset)
    {
        $emailJobs = new LinkResetMail($reset);
        $this->dispatch($emailJobs);
    }

    protected function createNewReset($email)
    {
        return $this->password_reset->insert([
            "email" => $email,
            "token" => $this->createTokenResetPassword($email),
            "created_at" => Carbon::now()
        ]);
    }

    protected function createTokenResetPassword($email)
    {
        return uniqid();
    }

    public function tokenResetPasswordExist(TokenResetPasswordRequest $request)
    {
        return Utility::responseValid("token valid");
    }

    public function resetPassword(EmailTokenPasswordRequest $request)
    {
        try {
            $request = (object) $request->validated();
            $reset = (object) $this->getResetByToken($request->token);
            $user = $this->getUserByEmail($reset->email);

            if($user->fk_role_id != 1)
            {
                $user->password = Hash::make($request->password);
                $user->email_verified_at = Carbon::now();
                $user->save();
            } else {
                throw new Exception("utilisateur non autorisé");
            }

            $this->deleteReset($reset->email);
            return Utility::responseValid("Mot de passe mis à jour");

        } catch (Exception $e) {
            return Utility::responseError($e->getMessage(), "echec reset password");
        }



    }

    protected function getUserByEmail($email){
        return User::where('user_email', $email)->first();
    }
}
