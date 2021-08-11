<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/', 'namespace' => 'Front'], function () {
   Route::get('payment-success', 'PaymentController@successPage')
       ->name('payment.success');
   Route::put('payment-notify', 'PaymentController@notification')
       ->name('payment.notify');
});
