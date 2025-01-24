<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth.api:admins'], function () {
    Route::get('/test', [UserController::class, 'index']);
});
