@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="card">
         <div class="card-body">
                <h4 class="card-title heading-3 text-center">Riwayat Pemesanan</h4><br>
                <h4 class="card-title heading-6">Tanggal Pesan : 30 Mei 2023 12:30:00 </h4>
                <h4 class="card-title heading-6">Total Harga &nbsp;&nbsp; : Rp. 15.000</h4>
                <h4 class="card-title heading-6">Metode Pembayaran : <span
                        class="font-weight-bold text-uppercase font-italic">Tunai</span><br></h4><hr>
                <a href="{{ url('designnota') }}" class="btn btn-success btn-block">Lihat Detail Pesanan</a>
            </div>
        </div><br>
    @endsection
