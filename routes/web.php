<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/webpay-plus', 'home')->name('webpay-plus');
Route::view('/oneclick-mall', 'home')->name('oneclick-mall');
Route::view('/transaccion-completa', 'home')->name('transaccion-completa');
Route::view('/patpass-comercio', 'home')->name('patpass');
