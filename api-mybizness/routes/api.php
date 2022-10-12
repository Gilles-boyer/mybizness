<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FontController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\ScriptController;
use App\Http\Controllers\OrderedController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ClassNameController;
use App\Http\Controllers\RoleMethodController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ScriptMehodController;
use App\Http\Controllers\ApplicationMethodController;

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
Route::delete("/role/{role}/delete",[RoleController::class, 'destroy']);
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
Route::put("/voucher/{voucher}/update/validity/{day}",  [VoucherController::class, 'updateValidity']);
Route::get("/voucher/display/pdf/{uuid}", [VoucherController::class, 'displayVoucher']);
Route::get("/voucher/download/pdf/{uuid}", [VoucherController::class, 'downloadVoucher']);
Route::get("/voucher/{uuid}/send/mail/{email}", [VoucherController::class, 'sendVoucherByMail']);
Route::put("/voucher/product/order/{productOrder}", [VoucherController::class, 'updateUsedProduct']);
//order
Route::get("/orders/get", [OrderedController::class, "index"]);
Route::Delete("/order/delete/{order}", [OrderedController::class, 'destroy']);
//product
Route::get("/products/online/get", [ProductController::class, "indexOnline"]);
Route::get("/products", [ProductController::class, "index"]);
Route::put("/product/{product}/update", [ProductController::class, "update"]);
Route::post("/product/store", [ProductController::class, "store"]);
Route::delete("/product/{product}/delete", [ProductController::class, "destroy"]);
Route::put("/product/{product}/online", [ProductController::class, "updateOnline"]);
//category
Route::get("/categories/online/get", [CategoryController::class, "indexOnline"]);
Route::get("/categories", [CategoryController::class, "index"]);
Route::put("/category/{category}/update", [CategoryController::class, "update"]);
Route::post("/category/store", [CategoryController::class, "store"]);
Route::delete("/category/{category}/delete", [CategoryController::class, "destroy"]);
//image
Route::get("/images/online/get", [ImageController::class, "indexOnline"]);
Route::get("/images", [ImageController::class, "index"]);
Route::put("/image/{image}/update", [ImageController::class, "update"]);
Route::post("/image/store", [ImageController::class, "store"]);
Route::delete("/image/{image}/delete", [ImageController::class, "destroy"]);
Route::put("/image/{image}/online", [ImageController::class, "updateOnline"]);
//font
Route::get("/fonts/online/get", [FontController::class, "indexOnline"]);
Route::get("/fonts", [FontController::class, "index"]);
Route::put("/font/{font}/update", [FontController::class, "update"]);
Route::post("/font/store", [FontController::class, "store"]);
Route::delete("/font/{font}/delete", [FontController::class, "destroy"]);
Route::put("/font/{font}/online", [FontController::class, "updateOnline"]);
//color
Route::get("/colors/online/get", [ColorController::class, "indexOnline"]);
Route::get("/colors", [ColorController::class, "index"]);
Route::put("/color/{color}/update", [ColorController::class, "update"]);
Route::post("/color/store", [ColorController::class, "store"]);
Route::delete("/color/{color}/delete", [ColorController::class, "destroy"]);
Route::put("/color/{color}/online", [ColorController::class, "updateOnline"]);
//shipping
Route::get("/shippings/online/get", [ShippingController::class, "indexOnline"]);
Route::get("/shippings", [ShippingController::class, "index"]);
Route::put("/shipping/{shipping}/update", [ShippingController::class, "update"]);
Route::post("/shipping/store", [ShippingController::class, "store"]);
Route::delete("/shipping/{shipping}/delete", [ShippingController::class, "destroy"]);
Route::put("/shipping/{shipping}/online", [ShippingController::class, "updateOnline"]);
//payment
Route::get("/payments/online/get", [PaiementController::class, "index"]);
Route::put("/payment/{payment}/update", [PaiementController::class, "update"]);
Route::post("/payment/store", [PaiementController::class, "store"]);
Route::delete("/payment/{payment}/delete", [PaiementController::class, "destroy"]);
//method
Route::get("/methods", [MethodController::class, "index"]);
//user
Route::get("/users", [UserController::class,'index']);
Route::post("/user/store", [UserController::class, "store"]);
Route::put("/user/{user}/update", [UserController::class, "update"]);
Route::delete("/user/{user}/delete", [UserController::class, "destroy"]);
//application
Route::get("/applications", [ApplicationController::class, "index"]);
Route::put("/application/{application}/update", [ApplicationController::class, "update"]);
Route::post("/application/store", [ApplicationController::class, "store"]);
Route::delete("/application/{application}/delete", [ApplicationController::class, "destroy"]);
Route::put("/application/{application}/activate", [ApplicationController::class, "updateActivate"]);


