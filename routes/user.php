<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\BrandController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\CityController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

\Illuminate\Support\Facades\DB::listen(function (\Illuminate\Database\Events\QueryExecuted $query){
    logger($query->sql, $query->bindings);
});

Route::get('/city/index', [CityController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/verifyEmailOtp', [AuthController::class, 'verifyEmailOtp']);

Route::post('/resendOtp', [AuthController::class, 'resendOtp']);

Route::post('/sendOtpForResetPassword', [AuthController::class, 'sendOtpForResetPassword']);
Route::post('/verifyPasswordOtp', [AuthController::class, 'verifyPasswordOtp']);

Route::group(['middleware' => ['auth.api:users','abilities:reset-password']], function () {
    Route::post('/resetPassword', [AuthController::class, 'resetPassword']);
});


Route::group(['middleware' => 'auth.api:users'], function (){

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/showProfile', [UserController::class, 'showProfile']);
    Route::post('/updateProfile', [UserController::class, 'updateProfile']);
    Route::post('/updatePassword', [UserController::class, 'updatePassword']);
    Route::post('/deleteProfile', [UserController::class, 'deleteProfile']);
});

Route::group(['prefix' => '/brand'], function (){
    Route::get('/index', [BrandController::class, 'index']);
    Route::get('/show/{id}', [BrandController::class, 'get_one']);
});

Route::group(['prefix' => '/category'], function (){
    Route::get('/index', [CategoryController::class, 'index']);
    Route::get('/show/{id}', [CategoryController::class, 'get_one']);
});

Route::group(['prefix' => '/product'], function (){
    Route::get('/index', [ProductController::class, 'index']);
    Route::get('/search', [ProductController::class, 'search']);
    Route::get('/show/{id}', [ProductController::class, 'get_one']);
});

Route::group(['prefix' => '/order', 'middleware' => 'auth.api:users'], function (){
    Route::get('/index', [OrderController::class, 'index']);
    Route::get('/show/{id}', [OrderController::class, 'get_one']);
    Route::post('/store', [OrderController::class, 'store']);
});

Route::group(['prefix' => '/comment', 'middleware' => 'auth.api:users'], function (){
    Route::post('/store', [CommentController::class, 'store']);
    Route::post('/update/{id}', [CommentController::class, 'update']);
    Route::post('/delete/{id}', [CommentController::class, 'destroy']);
});

Route::group(['prefix' => '/review', 'middleware' => 'auth.api:users'], function (){
    Route::post('/store', [ReviewController::class, 'store']);
    Route::post('/delete/{id}', [ReviewController::class, 'destroy']);
});








