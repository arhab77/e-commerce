<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\SliderController;
use App\Models\product;
use Faker\Provider\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('admin',[AuthController::class, 'login']);
    Route::post('register',[AuthController::class, 'register']);
    Route::post('logout',[AuthController::class,'logout']);
});

Route::group([

    'middleware' => 'api'

], function () {
    Route::resources([
        'categories' =>CategoryController::class,
        'sliders' =>SliderController::class,
        'products' =>ProductController::class,
        'members' => MemberController::class,
        'orders' => OrderController::class,
        'payment' => PaymentController::class
    ]);

    route::get('pesanan/baru',[OrderController::class,'baru']);
    route::get('pesanan/dikonfirmasi',[OrderController::class,'dikonfirmasi']);
    route::get('pesanan/dikemas',[OrderController::class,'dikemas']);
    route::get('pesanan/dikirim',[OrderController::class,'dikirim']);
    route::get('pesanan/diterima',[OrderController::class,'diterima']);
    route::get('pesanan/selesai',[OrderController::class,'selesai']);

    Route::post('pesanan/ubah_status/{order}',[OrderController::class,'ubah_status']);

    route::get('reports',[reportController::class,'get_reports']);
});