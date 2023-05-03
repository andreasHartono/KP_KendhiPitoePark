<?php

use App\Http\Controllers\CafeController;
use App\Http\Controllers\CategoryFoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
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

Route::get('/', [CafeController::class,'index']);

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
});
Route::resources([
    'cafes' => CafeController::class,
    'categories' => CategoryFoodController::class,
    'order' => OrderController::class,
    'orderdetails' => OrderDetailsController::class
]);