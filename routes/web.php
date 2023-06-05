<?php

use App\Http\Controllers\CafeController;
use App\Http\Controllers\CategoryFoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\EWalletController;
use App\Http\Controllers\MejaController;
use Illuminate\Support\Facades\Auth;
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


//LOGIN REGISTER
Route::get('/login', [AccountController::class, 'index'])->name('login');
Route::post('/login_detail', [AccountController::class, 'authenticate']);
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
Route::get('/register', [AccountController::class, 'indexRegister'])->name('register');
Route::post('/register_detail', [AccountController::class, 'create']);

Route::get('/', [CafeController::class, 'index'])->name("index");

Route::get('add-to-cart', [CafeController::class, 'addToCart'])->name('addToCart');
Route::get('cart', [CafeController::class, 'cart']);
Route::post('/checkout_tunai', [OrderController::class, 'goToQR'])->name("checkout_tunai");

Route::get('/checkout', function () {
   return view('menu.checkout');
})->name('checkout');

Route::middleware(['auth'])->group(function () {

   // HALAMAN PELANGGAN

   Route::get('/pembayarancustomer', function () {
      return view('transaction.verifikasipembayaran');
   });

   Route::get('/ewallet/isiewallet', [EWalletController::class, 'isiEwallet'])->name('isi_ewallet');
   Route::get('/ewallet/checkout_ewallet',[EWalletController::class,'checkoutEwallet'])->name('checkout_ewallet');
   Route::get('/notapembayaran', function () {
      return view('transaction.notapembayaran');
   });

   Route::get('/lacakpesanan', function () {
      return view('pelanggan.lacakpesanan');
   })->name("lacak_pesanann");

   Route::get('/rekappenjualanpegawai', [OrderController::class, 'rekap_penjualan_pegawai'])->name('rekap_pegawai');

   Route::get('/rekaptotal', [OrderController::class, 'report_penjualan'])->name('report_penjualan');
   Route::get('/rekaptotaldetil', [OrderController::class, 'report_penjualan_detil'])->name('report_penjualan_detil');


   Route::get('/datapegawai', function () {
      return view('owner.datapegawai');
   })->name("data_pegawai");

   Route::get('/pegawai', function () {
      return view('layouts.admin');
   })->name('pegawai');

   Route::get('/logewallet', function () {
      return view('owner.ewallet');
   })->name('log_ewallet');

   Route::get('/profilpegawai', function () {
      return view('kasir.profilkasir');
   })->name("profil_pegawai");

   Route::get('/profilowner', function () {
      return view('owner.profil');
   })->name("profil_owner");

   Route::get('/notapembayaran', function () {
      return view('transaction.notapembayaran');
   });

   Route::get('/lacakpesanan', function () {
      return view('pelanggan.lacakpesanan');
   })->name("lacak_pesanan");

   Route::get('/membershiptopup', function () {
      return view('pelanggan.topup');
   })->name('pelanggan_topup');

   Route::get('/profilpelanggan', function () {
      return view('pelanggan.profilpelanggan');
   })->name('profil_pelanggan');


   Route::get('/datapegawai', function () {
      return view('owner.datapegawai');
   })->name("data_pegawai");

   Route::get('/profilpegawai', function () {
      return view('kasir.profilkasir');
   })->name("profil_pegawai");

   Route::get('/pegawai', function () {
      return view('layouts.admin');
   })->name('pegawai');

   Route::get('/profilowner', function () {
      return view('owner.profil');
   })->name("profil_owner");

   Route::get('/qrcodemeja', [MejaController::class, 'index'])->name('meja.index');
   Route::post('/buatlinkmeja', [MejaController::class, 'store'])->name('meja.store');
   Route::get('generateqrcode/{id}', [MejaController::class, 'generate'])->name('meja.generate');
   Route::get('/kendhipitoe/{hash}', [MejaController::class, 'generateSignedUrl'])->name('meja.generateUrl');
});
Route::get('/historypemesanan', function () {
   return view('pelanggan.history');
});
Route::get('/designnota', function () {
   return view('transaction.invoicedesign');
});
Route::get('/designnotadapur', function () {
   return view('transaction.invoicedapur');
});


Route::get('/scankasir', function () {
   return view('kasir.scan');
})->name("scan_kasir");



Route::get('/order/checkout', [OrderController::class, 'checkout'])->name('checkout_order');
Route::get('/order/validasipembayaran', [OrderController::class, 'validasipembayaran'])->name('validasi_pembayaran');


//TARUK RESOURCE PALING BAWAH
Route::get('/logins', function () {
   return view('auth.login');
});



Route::resources([
   'cafes' => CafeController::class,
   'categories' => CategoryFoodController::class,
   'order' => OrderController::class,
   'orderdetails' => OrderDetailsController::class,
   'ewallet' => EWalletController::class

]);
