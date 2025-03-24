<?php

use App\Http\Controllers\WebpayController;
use App\Http\Controllers\WebpayPlusMallController;
use App\Http\Controllers\WebpayPlusDeferredController;
use App\Http\Controllers\WebpayPlusMallDeferredController;
use App\Http\Controllers\OneclickMallController;
use App\Http\Controllers\OneclickMallDeferredController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home')->name('home');
Route::view('/oneclick-mall', 'home')->name('oneclick-mall');
Route::view('/transaccion-completa', 'home')->name('transaccion-completa');
Route::view('/patpass-comercio', 'home')->name('patpass');

Route::prefix('webpay-plus')->name("webpay.")->group(function () {
    Route::get('/create', [WebpayController::class, 'create'])->name("create");
    Route::match(['get', 'post'], '/commit', [WebpayController::class, 'commit'])
        ->name("commit");
    Route::post('/refund', [WebpayController::class, 'refund'])->name("refund");
    Route::get('/status', [WebpayController::class, 'status'])->name("status");
});

Route::prefix('webpay-mall')->name("webpay-mall.")->group(function () {
    Route::get('/create', [WebpayPlusMallController::class, 'create'])->name("create");
    Route::get('/commit', [WebpayPlusMallController::class, 'commit'])->name("commit");
    Route::post('/refund', [WebpayPlusMallController::class, 'refund'])->name("refund");
    Route::get('/status', [WebpayPlusMallController::class, 'status'])->name("status");
});

Route::prefix('webpay-plus-diferido')->name("webpay-deferred.")->group(function () {
    Route::get('/create', [WebpayPlusDeferredController::class, 'create'])->name("create");
    Route::get('/commit', [WebpayPlusDeferredController::class, 'commit'])->name("commit");
    Route::post('/capture', [WebpayPlusDeferredController::class, 'capture'])->name("capture");
    Route::post('/refund', [WebpayPlusDeferredController::class, 'refund'])->name("refund");
    Route::get('/status', [WebpayPlusDeferredController::class, 'status'])->name("status");
});

Route::prefix('webpay-mall-diferido')->name("webpay-mall-deferred.")->group(function () {
    Route::get('/create', [WebpayPlusMallDeferredController::class, 'create'])->name("create");
    Route::get('/commit', [WebpayPlusMallDeferredController::class, 'commit'])->name("commit");
    Route::post('/capture', [WebpayPlusMallDeferredController::class, 'capture'])->name("capture");
    Route::post('/refund', [WebpayPlusMallDeferredController::class, 'refund'])->name("refund");
    Route::get('/status', [WebpayPlusMallDeferredController::class, 'status'])->name("status");
});

Route::prefix('oneclick-mall')->name("oneclick-mall.")->group(function () {
    Route::get('/start', [OneclickMallController::class, 'startInscription'])->name("start");
    Route::get('/finish', [OneclickMallController::class, 'finishInscription'])->name("finish");
    Route::post('/authorize', [OneclickMallController::class, 'authorizeMall'])->name("authorize");
    Route::get('/delete', [OneclickMallController::class, 'deleteInscription'])->name("delete");
    Route::post('/refund', [OneclickMallController::class, 'refund'])->name("refund");
    Route::get('/status', [OneclickMallController::class, 'status'])->name("status");
});
Route::prefix('oneclick-mall-diferido')->name("oneclick-mall-deferred.")->group(function () {
    Route::get('/start', [OneclickMallDeferredController::class, 'startInscription'])->name("start");
    Route::get('/finish', [OneclickMallDeferredController::class, 'finishInscription'])->name("finish");
    Route::post('/authorize', [OneclickMallDeferredController::class, 'authorizeMall'])->name("authorize");
    Route::get('/delete', [OneclickMallDeferredController::class, 'deleteInscription'])->name("delete");
    Route::get('/status', [OneclickMallDeferredController::class, 'status'])->name("status");
    Route::post('/refund', [OneclickMallDeferredController::class, 'refund'])->name("refund");
    Route::post('/capture', [OneclickMallDeferredController::class, 'capture'])->name("capture");
});
