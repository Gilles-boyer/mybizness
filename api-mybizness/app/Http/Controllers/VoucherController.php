<?php

namespace App\Http\Controllers;

use App\Http\Resources\VoucherResource;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    protected $rules = [
        "theme" => "required|exists:App\Models\Theme,id",
        "backgroundColor" => "required|string",
        "fontFamily" => "required|string",
        "message" => "required|string",
    ];

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $validator = $this->validateId(["id" => $id], "Voucher");

        if ($validator->fails()) {
            return Utility::responseError(
                $validator->errors(),
                "echec validation"
            );
        }

        $voucher = Voucher::find($id);

        return new VoucherResource($voucher);
    }
}
