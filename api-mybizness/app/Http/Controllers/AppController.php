<?php

namespace App\Http\Controllers;

use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AppController extends Controller
{
    public function index()
    {
        return view('app');
    }

    public function voucher()
    {
        return view('voucher');
    }

    public function pdf()
    {
        $qrcode = QrCode::size(70)->generate("Je suis un QR Code");
        $qrcode = base64_encode($qrcode);
        $qrcode = "data:image/png;base64,".$qrcode;
        $pdf = PDF::loadView('voucher', compact('qrcode'));
        return $pdf->stream();;
    }
}
