<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    /**
     * create qrcode img base64
     * @param int $size
     * @param string $data
     * @return Qrcode
     */
    public static function createQrCodeBase64(int $size, string $data)
    {
        return self::encodeQrCodeBase64(self::generateQrCode($size, $data));
    }

    /**
     * generate qr code with string
     * @param int $size
     * @param string $data
     * @return SimpleSoftwareIO\QrCode\Facades\QrCode
     */
    public static function generateQrCode(int $size, string $data)
    {
        return QrCode::size($size)->generate($data);
    }

    /**
     * encode img qr code to base64 img
     * @param $qrCode
     * return img base64
     */
    public static function encodeQrCodeBase64($qrCode)
    {
        return "data:image/png;base64," . base64_encode($qrCode);
    }
}
