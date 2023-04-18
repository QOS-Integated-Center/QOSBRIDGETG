<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AccountHolderController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Account Holder

Route::post('/QosicBridge/tg/user/getaccountholderinfo', [AccountHolderController::class, 'getAccountHolderInfo']);
Route::post('/QosicBridge/tg/user/getaccountholderinfomv', [AccountHolderController::class, 'getAccountHolderInfo']);
Route::post('/QosicBridge/tg/user/addaccountholderinfomv', [AccountHolderController::class, 'addAccountHolder']);
Route::post('/QosicBridge/tg/user/addaccountholderinfo', [AccountHolderController::class, 'addAccountHolder']);
Route::post('/QosicBridge/tg/user/deleteaccountholderinfo', [AccountHolderController::class, 'deleteAccountHolder']);
Route::post('/QosicBridge/tg/user/updateaccountholderinfo', [AccountHolderController::class, 'updateAccountHolder']);

Route::post('/QosicBridge/tg/user/deposit', [PaymentController::class, 'deposit']);
Route::post('/QosicBridge/tg/user/depositmv', [PaymentController::class, 'deposit']);
Route::post('/QosicBridge/tg/user/requestpayment', [PaymentController::class, 'requestPayment']);
Route::post('/QosicBridge/tg/user/requestpaymentmv', [PaymentController::class, 'requestPayment']);
Route::post('/QosicBridge/tg/user/gettransactionstatus', [PaymentController::class, 'getTransactionStatus']);
Route::post('/QosicBridge/tg/user/refund', [PaymentController::class, 'getRefund']);
Route::post('/QosicBridge/tg/user/getavailableamountowithdraw', [PaymentController::class, 'getAvailableAmounToWithdraw']);
// Route::post('/QosicBridge/tg/user/getaccountholderinfo', [PaymentController::class, 'getAccountHolderInfo']);



