<?php

use App\Http\Controllers\CafeController;
use App\Http\Controllers\CategoryFoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\LoginController;
use App\Models\Cafe;
use App\Models\CategoryFood;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/login', [LoginController::class,'authenticate']);
Route::get('/', [CafeController::class,'index'])->name("index");

Route::get('add-to-cart/{id}',[CafeController::class,'addToCart']);
Route::get('cart',[CafeController::class,'cart']);
Route::get('/checkout',function() {
   return view('menu.checkout');
});
Route::get('/pembayarancustomer',function() {
   return view('transaction.verifikasipembayaran');
});
Route::get('/validasipembayaran', function () {
   return view('transaction.validasipembayaran');
})->name('validasipembayaran');

Route::get('/notapembayaran', function () {
   return view('transaction.notapembayaran');
});
Route::get('/lacakpesanan', function () {
   return view('transaction.lacakpesanan');
});
Route::get('/membershiptopup', function () {
   return view('membership.topup');
});
Route::get('/scankasir', function () {
   return view('kasir.scan');
})->name("scankasir");


Route::get('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('/order/validasiPembayaran', [OrderController::class, 'validasiPembayaran'])->name('validasiPembayaran');


//TARUK RESOURCE PALING BAWAH
Route::get('/logins', function () {
   return view('auth.login');
});
Route::resources([
    'cafes' => CafeController::class,
    'categories' => CategoryFoodController::class,
    'order' => OrderController::class,
    'orderdetails' => OrderDetailsController::class,
    'qrcode'=> QrCodeController::class,
]);








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
