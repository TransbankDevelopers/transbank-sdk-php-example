<?php

use App\Http\Controllers\WebpayController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home')->name('home');
Route::view('/oneclick-mall', 'home')->name('oneclick-mall');
Route::view('/transaccion-completa', 'home')->name('transaccion-completa');
Route::view('/patpass-comercio', 'home')->name('patpass');

Route::prefix('webpay-plus')->name("webpay.")->group(function () {
    Route::get('/create', [WebpayController::class, 'index'])->name("create");
    Route::get('/commit', [WebpayController::class, 'commit'])->name("commit");
    Route::post('/refund', [WebpayController::class, 'refund'])->name("refund");
    Route::get('/status', [WebpayController::class, 'status'])->name("status");
});

Route::prefix('webpay-plus-mall')->name("webpay-mall.")->group(function () {
    Route::get('/create', [WebpayController::class, 'index'])->name("create");
    Route::get('/commit', [WebpayController::class, 'commit'])->name("commit");
    Route::post('/refund', [WebpayController::class, 'refund'])->name("refund");
    Route::get('/status', [WebpayController::class, 'status'])->name("status");
});
