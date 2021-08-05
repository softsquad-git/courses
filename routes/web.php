<?php

\Illuminate\Support\Facades\Route::group(['namespace' => 'App\Http\Controllers'], function () {
    include 'web/web.front.php';
    include 'web/web.admin.php';
    include 'web/web.user.php';
});
