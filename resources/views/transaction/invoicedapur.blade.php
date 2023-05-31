@extends('layouts.auth')
@section('content')
    <div class="card card-outline">
        <div class="card-header text-center">
            <img src="{{ asset('template/assets/images/pitoe.png') }}" alt="logo" height="150" width="150">
            <h4>Kendhi Pitoe Park</h4>
            <small> Kali Jaten, Selotapak, Kec. Trawas, Kabupaten Mojokerto, Jawa Timur</small>
        </div>
        <div class="card-body">
            <b>No Meja : </b> <span class="font-weight-bold">12</span><br>
            <b>Nama Pelanggan : </b> Andre<br>
            <b>Nama Kasir : </b> Agus<br>
            <b>Tanggal Transaksi : </b> 30 Mei 2023 12:30:00<br><hr>
            <h3>Menu yang Dipesan</h3>
            <b>Nasi Goreng</b><br>
            <div class="row">
               <div class="col-8"><b>1 x </b>&nbsp;&nbsp;&nbsp;15.000</div>
               <div class="col-4"><b>Rp. 15.000</b></div>
            </div>
            <b>Kentang Goreng</b><br>
            <div class="row">
               <div class="col-8"><b>2 x </b>&nbsp;&nbsp;&nbsp;10.000</div>
               <div class="col-4"><b>Rp. 20.000</b></div>
            </div>
            <b>Es Teh</b><br>
            <div class="row">
               <div class="col-8"><b>1 x </b>&nbsp;&nbsp;&nbsp;5.000</div>
               <div class="col-4"><b>Rp. 5.000</b></div>
            </div><hr>
            <span class="text-center">
               <h4>Matur Nuwun sampun</h4>
               <h5>Rawuh ing</h5>
               <h3>Kendhi Pitoe Park</h3>
            </span>
        </div>
    </div>
@endsection
