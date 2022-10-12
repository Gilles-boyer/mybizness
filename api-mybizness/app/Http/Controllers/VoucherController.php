<?php

namespace App\Http\Controllers;

use Exception;
use Ramsey\Uuid\Uuid;
use App\Models\Voucher;
use App\Http\Controllers\Utility;
use App\Http\Resources\VoucherResource;
use App\Http\Controllers\EmailController;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Validator;


/**
 * Observable : true
 * Name : Voucher
 * Description : list methods for voucher controller
 */
class VoucherController extends Controller
{
    public $ruleVoucher = [
        'message'           => "required|string",
    ];

    /**
     * create validator voucher by id
     * @param int $id
     * @param string $next
     * @return function validateVoucherId
     */
    public function createValidatorVoucherId(int $id, string $next)
    {
        $validator = $this->validateId(["id" => $id], "Voucher");
        return $this->validateVoucherId($validator, $next);
    }

    /**
     * validate voucher id
     * @param Validate $validator
     * @param string  $next
     * @return function  call_user_func_array
     */
    public function validateVoucherId($validator, string $next)
    {
        if ($validator->fails()) {
            return Utility::responseError(
                $validator->errors(),
                "echec validation"
            );
        }
        return call_user_func_array(array($this, $next), $validator->validated());
    }

    /**
     * get specific voucher by id
     * @param int $id
     * @return App\Http\Resources\VoucherResource
     */
    public function getVoucherById(int $id): VoucherResource
    {
        return  new VoucherResource(Voucher::find($id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->createValidatorVoucherId($id, "getVoucherById");
    }

    public function validatorMessageVoucher($message)
    {
        $request = [
            'message'           => $message,
        ];
        return  Validator::make(
            $request,
            $this->ruleVoucher,
            Utility::$errors
        );
    }

    public function validatedVoucher($validator)
    {
        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        return $validator->validated();
    }

    /**
     * Observable : true
     * Name : generate new voucher
     * Description : create new voucher online
     */
    public function generateVoucher($request, $results)
    {
        $personalization = $request->personalization;
        if(gettype($request->personalization) === "string"){
            $personalization    =   json_decode($personalization);
        }
        $personalization =(object)$personalization;
        $validator = $this->validatorMessageVoucher($personalization->message);
        $validated = $this->validatedVoucher($validator);
        $results['message'] =   $validated['message'];
        $results['voucher'] =   $this->store($results);
        return $results;
    }

    /**
     * store new voucher
     * @param
     * @return App\Http\Resources\VoucherResource
     */
    public function store($request)
    {
        $voucher = new Voucher();
        $voucher->voucher_num = (string)Uuid::uuid4();
        $voucher->voucher_validity = date("Y-m-d", strtotime(now() . ' + 100 days'));
        $voucher->voucher_message = $request['message'];
        $voucher->fk_image_id = $request['image']->id;
        $voucher->fk_font_id = $request['font']->id;
        $voucher->fk_color_id = $request['color']->id;
        $voucher->fk_order_id = $request['order']->id;
        $voucher->fk_shipping_id = $request['shipping']->id;
        $voucher->save();
        return new VoucherResource($voucher);
    }

    /**
     * Update Validity days
     * @param int $id
     * @param int $days
     * @return function addMoreDaysValidityVoucher
     */
    public function updateValidity(Voucher $voucher, int $days)
    {
        try {
            return $this->addMoreDaysValidityVoucher(
                $voucher,
                $this->validateDays((int)$days)
            );
        } catch (Exception $e) {
            return Utility::responseError($e->getMessage());
        }
    }

    /**
     * validate add days for voucher validity
     * @param int $days
     * @return int $days
     */
    public function validateDays(int $days)
    {
        if (!($days > 0 && $days <= 100)) {
            throw new Exception("nombre de jour invalide");
        }
        return $days;
    }

    /**
     * add more day validity for specific voucher
     * @param Voucher $voucher
     * @param int $days
     * @return Response
     */
    public function addMoreDaysValidityVoucher($voucher,int $days)
    {
        $voucher->voucher_validity =  date("Y-m-d", strtotime($voucher->voucher_validity . " + $days days"));
        $voucher->save();
        return Utility::responseValid("Validité voucher mis à jour");
    }

    /**
     * delete voucher by id
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        return $this->deleteVoucher($this->show($id));
    }

    /**
     * delete voucher
     * @param Voucher $voucher
     * @return Response
     */
    public function deleteVoucher($voucher)
    {
        try {
            $voucher->forceDelete();
        } catch (Exception $e) {
            return Utility::responseError("voucher non trouvé");
        }
        return Utility::responseValid("voucher effacé");
    }

    /**
     * display in navigator voucher by uuid
     * @param string  $uuid
     * @return view
     */
    public function displayVoucher(string $uuid)
    {
        try {
            return PdfController::displayPdf(PdfController::generateVoucherPdf($this->getVoucherByUuid($uuid)));
        } catch (Exception $e) {
            Utility::responseError($e->getMessage());
        }
    }
    /**
     * download voucher by uuid
     * @param string $uuid
     * @return file pdf
     */
    public function downloadVoucher(string $uuid)
    {
        try {
            return PdfController::downloadPdf(PdfController::generateVoucherPdf($this->getVoucherByUuid($uuid)), "voucher.pdf");
        } catch (Exception $e) {
            Utility::responseError($e->getMessage());
        }
    }

    /**
     * create validator uuid
     * @param string $uuid
     * @return validator
     */
    public function validatorUuid(string $uuid)
    {
        return Validator::make(
            ['uuid' => $uuid],
            ['uuid' => "required|uuid|exists:App\Models\Voucher,voucher_num"],
            Utility::$errors
        );
    }

    /**
     * create validated uuid voucher
     * @param $validator
     * @return function validated
     */
    public function validatedUuid($validator)
    {
        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        return $validator->validated();
    }

    /**
     * get voucher by uuid
     * @param string $uuid
     * @return VoucherResource
     */
    public function getVoucherByUuid(string $uuid)
    {

        $uuid = $this->validatedUuid($this->validatorUuid($uuid));
        return new VoucherResource(Voucher::where('voucher_num', $uuid['uuid'])->first());
    }

    /**
     * send voucher by mail
     * @param string $uuid
     * @param string $mail
     * @return response
     */
    public function sendVoucherByMail(string $uuid, string $mail)
    {
        try {
            $email = new EmailController();
            $email->sendMailVoucher($this->getVoucherByUuid($uuid), $mail);
            return Utility::responseValid("mail envoyé");
        } catch (Exception $e) {
            Utility::responseError($e->getMessage());
        }
    }
    /**
     * update date used for specific ProductOrder
     * @param ProductOrder $productOrder
     * @return Response
     */
    public function updateUsedProduct(ProductOrder $productOrder)
    {
        $productOrder->used =  date("Y-m-d H:i:s", strtotime('+4 hours'));
        $productOrder->save();

        return Utility::responseValid("utilisation produit mis à jour");
    }
}
