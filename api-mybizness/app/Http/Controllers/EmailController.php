<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Jobs\VoucherSendEmail;
use App\Http\Resources\OrderResource;
use App\Http\Resources\VoucherResource;
use App\Jobs\ConfirmationOrderSendEmail;

/**
 * Observable : true
 * Name : Email
 * Description : list method for email controller
 */
class EmailController extends Controller
{
    /**
     * Send confirmation order
     * @param App\Models\Order $order
     * @return Illuminate\Support\Facades\Mail
     */
    public function sendConfirmationOrder(Order $order)
    {
        $emailJobs = new ConfirmationOrderSendEmail($order);
        $this->dispatch($emailJobs);
    }

    /**
     * Send voucher by mail
     * @param App\Models\Voucher $voucher
     * @param string $email
     * @return Illuminate\Support\Facades\Mail
     */
    public function sendMailVoucher($voucher, string $email)
    {
        $emailJobs = new VoucherSendEmail($voucher, $email);
        $this->dispatch($emailJobs);
    }

    /**
     * Observable : true
     * Name :voucher customer
     * Description : send voucher bon kdo for customer
     */
    public function loadVoucheCustomer($request, $results)
    {
        $this->sendMailVoucher($results['voucher'], $results['customer']->user_email);
        return  Utility::responseValid("commande traité", new OrderResource($results['order']));
    }

    /**
     * Observable : true
     * Name :voucher beneficiary
     * Description : send confirmation mail order
     */
    public function loadVoucherBeneficiary($request, $results)
    {
        $this->sendMailVoucher($results['voucher'], $results['beneficiary']->user_email);
        return  Utility::responseValid("commande traité", new OrderResource($results['order']));
    }

    /**
     * Observable : true
     * Name : mail order
     * Description : send confirmation mail order
     */
    public function loadConfirmationOrder($request, $results)
    {
        $this->sendConfirmationOrder($results['order']);
        return $results;
    }
}
