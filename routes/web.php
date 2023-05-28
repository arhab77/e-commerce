<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//auth
Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('login',[AuthController::class,'login']);
Route::get('logout',[AuthController::class,'logout']);

//member
Route::get('login_member',[AuthController::class,'login_member']);
Route::post('login_member',[AuthController::class,'login_member_action']);
Route::get('logout_member',[AuthController::class,'logout_member']);

Route::get('register_member',[AuthController::class,'register_member']);
Route::post('register_member',[AuthController::class,'register_member_action']);

//kategori
Route::get('/kategori',[CategoryController::class,'list']);
Route::get('/product',[ProductController::class,'list']);
Route::get('/slider',[SliderController::class,'list']);
Route::get('/payment',[PaymentController::class,'list']);

Route::get('/pesanan/baru',[OrderController::class,'list']);
Route::get('/pesanan/dikonfirmasi',[OrderController::class,'dikonfirmasi_list']);
Route::get('/pesanan/dikemas',[OrderController::class,'dikemas_list']);
Route::get('/pesanan/dikirim',[OrderController::class,'dikirim_list']);
Route::get('/pesanan/diterima',[OrderController::class,'diterima_list']);
Route::get('/pesanan/selesai',[OrderController::class,'selesai_list']);

Route::get('/laporan',[reportController::class,'index']);

Route::get('/dashboard',[DashboardController::class,'index']);

//home routes
Route::get('/',[HomeController::class,'index']);
Route::get('/product/{category}',[HomeController::class,'product']);
Route::get('/cart',[HomeController::class,'cart']);
Route::get('/checkout',[HomeController::class,'checkout']);
Route::get('/orders',[HomeController::class,'orders']);
Route::get('/shop/{products}',[HomeController::class,'shop']);
Route::get('/contact',[HomeController::class,'contact']);

Route::post('/add_to_cart',[HomeController::class,'add_to_cart']);
Route::get('/delete_from_cart/{cart}',[HomeController::class,'delete_from_cart']);
Route::get('/get_kota/{cart}',[HomeController::class,'get_kota']);
Route::get('/get_ongkir/{destination}/{weight}',[HomeController::class,'get_ongkir']);
Route::post('/checkout_orders',[HomeController::class,'checkout_orders']);
Route::post('/payments',[HomeController::class,'payments']);
Route::post('/pesanan_selesai/{order}',[HomeController::class,'pesanan_selesai']);

