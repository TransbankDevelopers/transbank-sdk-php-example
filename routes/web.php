<?php

use App\Http\Controllers\WebpayController;
use App\Http\Controllers\WebpayPlusMallController;
use App\Http\Controllers\WebpayPlusDeferredController;
use App\Http\Controllers\WebpayPlusMallDeferredController;
use App\Http\Controllers\OneclickMallController;
use App\Http\Controllers\OneclickMallDeferredController;
use Illuminate\Support\Facades\Route;

const CREATE_ENDPOINT = '/create';
const COMMIT_ENDPOINT = '/commit';
const CAPTURE_ENDPOINT = '/capture';
const REFUND_ENDPOINT = '/refund';
const STATUS_ENDPOINT = '/status';
const START_ENDPOINT = '/start';
const FINISH_ENDPOINT = '/finish';
const AUTHORIZE_ENDPOINT = '/authorize';
const DELETE_ENDPOINT = '/delete';

Route::view('/', 'home')->name('home');
Route::view('/oneclick-mall', 'home')->name('oneclick-mall');
Route::view('/transaccion-completa', 'home')->name('transaccion-completa');
Route::view('/patpass-comercio', 'home')->name('patpass');

Route::get('/api-reference/webpay-plus', [WebpayController::class, 'showOperations'])->name("webpay.api-operations");
Route::get('/api-reference/webpay-mall', [WebpayPlusMallController::class, 'showOperations'])->name("webpay-mall.api-operations");
Route::get('/api-reference/webpay-plus-diferido', [WebpayPlusDeferredController::class, 'showOperations'])->name("webpay-deferred.api-operations");
Route::get('/api-reference/webpay-mall-diferido', [WebpayPlusMallDeferredController::class, 'showOperations'])->name("webpay-mall-deferred.api-operations");
Route::get('/api-reference/webpay-oneclick-mall', [OneclickMallController::class, 'showOperations'])->name("oneclick-mall.api-operations");
Route::get('/api-reference/oneclick-mall-diferido', [OneclickMallDeferredController::class, 'showOperations'])->name("oneclick-mall-deferred.api-operations");

Route::prefix('webpay-plus')->name("webpay.")->group(function () {
    Route::get(CREATE_ENDPOINT, [WebpayController::class, 'create'])->name("create");
    Route::match(['get', 'post'], COMMIT_ENDPOINT, [WebpayController::class, 'commit'])
        ->name("commit");
    Route::get(REFUND_ENDPOINT, [WebpayController::class, 'refund'])->name("refund");
    Route::get(STATUS_ENDPOINT, [WebpayController::class, 'status'])->name("status");
});

Route::prefix('webpay-mall')->name("webpay-mall.")->group(function () {
    Route::get(CREATE_ENDPOINT, [WebpayPlusMallController::class, 'create'])->name("create");
    Route::get(COMMIT_ENDPOINT, [WebpayPlusMallController::class, 'commit'])->name("commit");
    Route::get(REFUND_ENDPOINT, [WebpayPlusMallController::class, 'refund'])->name("refund");
    Route::get(STATUS_ENDPOINT, [WebpayPlusMallController::class, 'status'])->name("status");
});

Route::prefix('webpay-plus-diferido')->name("webpay-deferred.")->group(function () {
    Route::get(CREATE_ENDPOINT, [WebpayPlusDeferredController::class, 'create'])->name("create");
    Route::get(COMMIT_ENDPOINT, [WebpayPlusDeferredController::class, 'commit'])->name("commit");
    Route::get(CAPTURE_ENDPOINT, [WebpayPlusDeferredController::class, 'capture'])->name("capture");
    Route::get(REFUND_ENDPOINT, [WebpayPlusDeferredController::class, 'refund'])->name("refund");
    Route::get(STATUS_ENDPOINT, [WebpayPlusDeferredController::class, 'status'])->name("status");
});

Route::prefix('webpay-mall-diferido')->name("webpay-mall-deferred.")->group(function () {
    Route::get(CREATE_ENDPOINT, [WebpayPlusMallDeferredController::class, 'create'])->name("create");
    Route::get(COMMIT_ENDPOINT, [WebpayPlusMallDeferredController::class, 'commit'])->name("commit");
    Route::get(CAPTURE_ENDPOINT, [WebpayPlusMallDeferredController::class, 'capture'])->name("capture");
    Route::get(REFUND_ENDPOINT, [WebpayPlusMallDeferredController::class, 'refund'])->name("refund");
    Route::get(STATUS_ENDPOINT, [WebpayPlusMallDeferredController::class, 'status'])->name("status");
});

Route::prefix('oneclick-mall')->name("oneclick-mall.")->group(function () {
    Route::get(START_ENDPOINT, [OneclickMallController::class, 'startInscription'])->name("start");
    Route::get(FINISH_ENDPOINT, [OneclickMallController::class, 'finishInscription'])->name("finish");
    Route::post(AUTHORIZE_ENDPOINT, [OneclickMallController::class, 'authorizeMall'])->name("authorize");
    Route::get(DELETE_ENDPOINT, [OneclickMallController::class, 'deleteInscription'])->name("delete");
    Route::get(REFUND_ENDPOINT, [OneclickMallController::class, 'refund'])->name("refund");
    Route::get(STATUS_ENDPOINT, [OneclickMallController::class, 'status'])->name("status");
});

Route::prefix('oneclick-mall-diferido')->name("oneclick-mall-deferred.")->group(function () {
    Route::get(START_ENDPOINT, [OneclickMallDeferredController::class, 'startInscription'])->name("start");
    Route::get(FINISH_ENDPOINT, [OneclickMallDeferredController::class, 'finishInscription'])->name("finish");
    Route::post(AUTHORIZE_ENDPOINT, [OneclickMallDeferredController::class, 'authorizeMall'])->name("authorize");
    Route::get(DELETE_ENDPOINT, [OneclickMallDeferredController::class, 'deleteInscription'])->name("delete");
    Route::get(STATUS_ENDPOINT, [OneclickMallDeferredController::class, 'status'])->name("status");
    Route::get(REFUND_ENDPOINT, [OneclickMallDeferredController::class, 'refund'])->name("refund");
    Route::get(CAPTURE_ENDPOINT, [OneclickMallDeferredController::class, 'capture'])->name("capture");
});
