<?php

namespace App\Mail;

use App\Http\Controllers\PdfController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VoucherMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $voucher;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $voucher = $this->voucher;
        $pdf = PdfController::generateVoucherPdf($voucher);

        return $this->from('noreply@cfg.re')
            ->view('mails.voucherEmail', compact("voucher"))
            ->subject('Votre bon cadeau cfg')
            ->attachData($pdf->output(), 'bonKdoCfg.pdf');
    }
}
