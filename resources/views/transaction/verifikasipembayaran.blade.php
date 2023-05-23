@extends('layouts.frontend')
@section('content')
   <div class="container">
      <div class="card">
         <div class="card-body">
            <h4 class="card-title heading-6">No Meja &nbsp;&nbsp;&nbsp; : {{ $_POST['no_meja'] }} </h4><br>
            <h4 class="card-title heading-6">Nama Customer : {{ $_POST['nama_customer'] }}</h4><br>
            <h4 class="card-title heading-6">Total Harga &nbsp;&nbsp; : {{ $_POST['total_price'] }}</h4><br>
            <!-- <h4 class="card-title heading-6">ID Transaksi : 08414912421</h4> -->
         </div>
         
         
      </div><br>
      <div class="card">
         <div class="card-header">
            <h4 class="card-title heading-4">
               QR CODE STRUK PEMBAYARAN TUNAI
            </h4>
         </div>
         <div class="card-body">
            <h3 class="card-text heading-3">              
               {!! QrCode::size(300)->generate($cart) !!}
            </h3>
         </div>
         <div class="card-footer">
            <h3 class="card-title heading-4">Tunjukkan QR CODE ini di Kasir</h3>
            <h6 class="card-title heading-6">Kemudian Tunggu Kasir untuk validasi Pembayaran dan akan muncul struk digital</h6>
         </div>
      </div>
   </div>
@endsection