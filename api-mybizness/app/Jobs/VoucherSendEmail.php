<?php

namespace App\Jobs;

use App\Mail\VoucherMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class VoucherSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $voucher;
    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($voucher, $email)
    {
        $this->voucher = $voucher;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $voucher = $this->voucher;
        $email = new VoucherMail($voucher);
        Mail::to($this->email)->send($email);
    }
}
