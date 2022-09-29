<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Order;
use App\Models\Voucher;
use App\Mail\VoucherMail;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AppController extends Controller
{
    public function index()
    {
        return view('app');
    }
}
