<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FontController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ScriptController;
use App\Http\Controllers\OrderedController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ClassNameController;
use App\Http\Controllers\RoleMethodController;
use App\Http\Controllers\ScriptMehodController;
use App\Http\Controllers\ApplicationMethodController;
use App\Http\Controllers\PaiementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get("/order/online",     [ScriptController::class, 'buyVoucher']);
// Route::get("/order/store",      [ScriptController::class, 'buyVoucher']);
// Route::post("/user/{type}/add", [UserController::class, 'store']);

//class
Route::get("/class/get/all", [ClassNameController::class, 'index']);
//Role
Route::get("/role/get/all", [RoleController::class, 'index']);
Route::post("/role/create", [RoleController::class, 'store']);
Route::put("/role/update/{role}", [RoleController::class, 'update']);
Route::get("role/{role}", [RoleController::class, 'show']);
//RoleMethod
Route::put("/rolemethod/update/relation", [RoleMethodController::class, 'update']);
//AppMethod
Route::put("/appmethod/update/relation", [ApplicationMethodController::class, 'update']);
//Script
Route::post("/script/create", [ScriptController::class, 'store']);
Route::get("/script/get/all", [ScriptController::class, 'index']);
Route::delete("/script/delete", [ScriptController::class, 'destroy']);
//MethodScript
Route::post("/method/script/create", [ScriptMehodController::class, 'processingScriptMethod']);
Route::delete("/method/script/delete/{id}", [ScriptMehodController::class, 'destroy']);
Route::get("/method/script/get/{id}", [ScriptMehodController::class, 'show']);
Route::post("/method/script/update/{id}", [ScriptMehodController::class, 'processingSubScriptMethod']);
//order voucher
Route::get("/load/script/voucher/online", [ScriptController::class, 'voucherOnLine']);
Route::post("/load/script/voucher/onsite", [ScriptController::class, 'voucherOnSite']);
//voucher
Route::get("/voucher/get/{uuid}", [VoucherController::class, 'getVoucherByUuid']);
Route::post("/voucher/create",  [VoucherController::class, 'store']);
Route::put("/voucher/{id}/update/validity/{day}",  [VoucherController::class, 'updateValidity']);
Route::Delete("/voucher/delete/{id}", [VoucherController::class, 'destroy']);
Route::get("/voucher/display/pdf/{uuid}", [VoucherController::class, 'displayVoucher']);
Route::get("/voucher/download/pdf/{uuid}", [VoucherController::class, 'downloadVoucher']);
Route::get("/voucher/{uuid}/send/mail/{email}", [VoucherController::class, 'sendVoucherByMail']);
//order
Route::get("/orders/get", [OrderedController::class, "index"]);
//product
Route::get("/products/online/get", [ProductController::class, "indexOnline"]);
//category
Route::get("/categories/online/get", [CategoryController::class, "indexOnline"]);
//image
Route::get("/images/online/get", [ImageController::class, "indexOnline"]);
//font
Route::get("/fonts/online/get", [FontController::class, "indexOnline"]);
//color
Route::get("/colors/online/get", [ColorController::class, "indexOnline"]);
//shipping
Route::get("/shippings/online/get", [ShippingController::class, "indexOnline"]);
//payment
Route::get("/payments/online/get", [PaiementController::class, "index"]);

