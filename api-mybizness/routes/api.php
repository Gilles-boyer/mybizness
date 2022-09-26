<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScriptController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\ClassNameController;
use App\Http\Controllers\ProcessingController;
use App\Http\Controllers\RoleMethodController;
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

Route::get("/order/online",     [ScriptController::class, 'buyVoucher']);
Route::get("/order/store",      [ScriptController::class, 'buyVoucher']);
Route::post("/user/{type}/add", [UserController::class, 'store']);

//class
Route::get("/class/get/all", [ClassNameController::class, 'index']);

//Role
Route::get("/role/get/all", [RoleController::class, 'index']);

//RoleMethod
Route::put("/rolemethod/update/relation", [RoleMethodController::class, 'update']);

//AppMethod
Route::put("/appmethod/update/relation", [ApplicationMethodController::class, 'update']);

//Script
Route::post("/script/create", [ScriptController::class, 'store']);
Route::get("/script/get/all", [ScriptController::class, 'index']);
Route::delete("script/delete", [ScriptController::class, 'destroy']);


//MethodScript
Route::post("/method/script/create", [ScriptMehodController::class, 'processingScriptMethod']);
Route::delete("/method/script/delete/{id}", [ScriptMehodController::class, 'destroy']);
Route::get("/method/script/get/{id}", [ScriptMehodController::class, 'show']);
Route::post("/method/script/update/{id}", [ScriptMehodController::class, 'processingSubScriptMethod']);

//
Route::get("/processing/script/{id}/{any}", [ProcessingController::class, 'index'])->where('any', '.*');

//voucher
Route::get("/voucher/get/{id}", [VoucherController::class, 'show']);
