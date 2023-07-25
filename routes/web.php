<?php

use App\Http\Controllers\CafeController;
use App\Http\Controllers\CategoryFoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\EWalletController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\PegawaiController;
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


Route::get('/lacakpesanantamu', function(){
   return view('pelanggan.lacakpesanantamu');
})->name("lacak_pesanan_tamu");


Route::get('/notaorder/{id}', [OrderController::class,'cetak_nota_pelanggan'])->name("nota_pelanggan");
Route::get('/notaorderdapur/{id}', [OrderController::class,'cetak_nota_dapur'])->name("nota_dapur");
Route::get('/lacakpesanantamudetil', [OrderController::class, 'lacak_pesanan_by_nomororder'])->name("lacak_pesanan_by_nomororder");
Route::get('/lacakpesanandetil/{id}', [OrderController::class, 'lacak_pesanan_detil'])->name("lacak_pesanan_detil");

//LOGIN REGISTER
Route::get('/login', [AccountController::class, 'index'])->name('login');
Route::post('/login_detail', [AccountController::class, 'authenticate']);
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
Route::get('/register', [AccountController::class, 'indexRegister'])->name('register');
Route::post('/register_detail', [AccountController::class, 'create']);
Route::get('/', [CafeController::class, 'index'])->name("index");
Route::get('/kendhipitoe/{idEncrypt}', [MejaController::class, 'generateSignedUrl'])->name('meja.generateUrl'); // jadi default


Route::get('add-to-cart', [CafeController::class, 'addToCart'])->name('addToCart');
Route::get('remove-from-cart', [CafeController::class, 'removeFromCart'])->name('removeFromCart');
Route::get('delete-from-cart', [CafeController::class, 'deleteFromCart'])->name('deleteFromCart');

Route::get('increase-cart', [CafeController::class, 'increaseQtyCart'])->name('increaseQtyCart');
Route::get('decrease-cart', [CafeController::class, 'decreaseQtyCart'])->name('decreaseQtyCart');
Route::get('delete-item-cart', [CafeController::class, 'deleteQtyCart'])->name('deleteQtyCart');
Route::post('/checkout_tunai', [OrderController::class, 'goToQR'])->name("checkout_tunai");
Route::get('/getmejanumber', [MejaController::class, 'meja_number'])->name('meja_number');
Route::get('/checkout', [MejaController::class, 'meja_number'])->name('checkout');


Route::get('/cart', function () {
   return view('menu.cart');
})->name('cart');

// HALAMAN PELANGGAN PERLU LOGIN
Route::middleware(['auth', 'role:pelanggan'])->group(function () {


   Route::get('/profilpelanggan', function () {
      return view('pelanggan.profilpelanggan');
   })->name('profil_pelanggan');

   Route::get('/pembayarancustomer', function () {
      return view('transaction.verifikasipembayaran');
   });

   Route::get('/notapembayaran', function () {
      return view('transaction.notapembayaran');
   });

   Route::get('/membershiptopup', function () {
      return view('pelanggan.topup');
   })->name('pelanggan_topup');

   Route::get('/profilepelanggan/update', [AccountController::class, 'update_profil'])->name('update_profil');
   Route::get('/ewallet/checkout_ewallet', [EWalletController::class, 'checkoutEwallet'])->name('checkout_ewallet');
   Route::get('/lacakpesananku', [OrderController::class, 'lacak_pesanan_ku'])->name("lacak_pesanan");

});


// HALAMAN PEGAWAI
Route::middleware(['auth', 'role:pegawai'])->group(function () {


   Route::get('/pegawai', function () {
      return view('kasir.selamatdatang');
   })->name('pegawai');

   Route::get('/datapegawai', [AccountController::class, 'data_pegawai'])->name('data_pegawai');
   Route::get('/createdatapegawai', function () {
      return view('owner.tambahdatapegawai');
   })->name('create_data_pegawai');

   Route::get('/storeedatapegawai', [AccountController::class, 'store_data_pegawai'])->name('store_data_pegawai');
     

   Route::get('/logewallet', function () {
      return view('owner.ewallet');
   })->name('log_ewallet');

   Route::get('/profilowner', function () {
      return view('owner.profil');
   })->name("profil_owner");
   

   Route::get('/scankasir', function () {
      return view('kasir.scan');
   })->name("scan_kasir");

   Route::get('/lacakpesanandetilpegawai/{id}', [OrderController::class, 'lacak_pesanan_detil_pegawai'])->name("lacak_pesanan_detil_pegawai");
   Route::get('/order/checkout', [OrderController::class, 'checkout'])->name('checkout_order');
   Route::get('/order/validasipembayaran', [OrderController::class, 'validasipembayaran'])->name('validasi_pembayaran');
   Route::get('/rekappenjualanpegawai', [OrderController::class, 'rekap_penjualan_pegawai'])->name('rekap_pegawai');
   Route::get('/printrekappenjualanpegawai/', [OrderController::class, 'print_rekap_penjualan_pegawai'])->name('print_rekap_pegawai');
   Route::get('/order/ganti_status_order', [OrderController::class, 'ganti_status_order'])->name('ganti_status_order');
   Route::get('/datamenupegawai', [CafeController::class, 'indexAdmin'])->name('data_menu');
   Route::get('/datakategori', [CategoryFoodController::class, 'indexAdmin'])->name('data_kategori');

   Route::get('/ewallet/isiewallet', [EWalletController::class, 'isiEwallet'])->name('isi_ewallet');
   Route::get('/rekaptotal', [OrderController::class, 'report_penjualan'])->name('report_penjualan');
   Route::get('/rekaptotaldetil', [OrderController::class, 'report_penjualan_detil'])->name('report_penjualan_detil');
   Route::get('/qrcodemeja', [MejaController::class, 'index'])->name('meja.index');
   Route::post('/buatlinkmeja', [MejaController::class, 'store'])->name('meja.store');
   //Route::get('generateqrcodemeja/{id}', [MejaController::class, 'generate'])->name('meja.generate');
   
});



//TARUK RESOURCE PALING BAWAH
Route::resources([
   'cafes' => CafeController::class,
   'categories' => CategoryFoodController::class,
   'order' => OrderController::class,
   'orderdetails' => OrderDetailsController::class,
   'ewallet' => EWalletController::class,   
   'meja' =>MejaController::class

]);
