<?php

namespace App\Http\Controllers;

use App\Jobs\ConfirmationOrderSendEmail;
use App\Jobs\VoucherSendEmail;
use App\Models\Order;
use App\Models\Voucher;
use App\Mail\VoucherMail;
use Illuminate\Http\Request;
use App\Mail\ConfirmationOrderMail;
use Illuminate\Support\Facades\Mail;

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
    public function sendMailVoucher(Voucher $voucher, string $email)
    {
        $emailJobs = new VoucherSendEmail($voucher, $email);
        $this->dispatch($emailJobs);
    }
}
