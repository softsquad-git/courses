<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {
   include 'api/api.admin.php';
   include 'api/api.user.php';
   include 'api/api.front.php';
   include 'api/api.auth.php';
});
