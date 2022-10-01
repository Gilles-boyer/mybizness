<?php

namespace App\Http\Controllers;

use PDF;
use App\Http\Controllers\QrCodeController;

class PdfController extends Controller
{
    /**
     * generate voucher pdf
     * @param App\Models\Voucher
     * @return PDF
     */
    public static function generateVoucherPdf($voucher)
    {
        $qrcode = QrCodeController::createQrCodeBase64(70, $voucher->voucher_num);
        return PDF::loadView('voucher', compact('qrcode', 'voucher'));
    }

    /**
     * display in view pdf
     * @param PDF $pdf
     * @return PDF
     */
    public static function displayPdf($pdf)
    {
        return $pdf->stream();
    }

    /**
     * download PDF
     * @param PDF $pdf
     * @param string $nameFile
     * @return PDF
     */
    public static function downloadPdf($pdf, string $nameFile)
    {
        return $pdf->download($nameFile);
    }
}
