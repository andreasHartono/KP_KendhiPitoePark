@extends('layouts.frontend')
@section('content')

@if ($userOrder == null)
<h5><i><b>Anda tidak memiliki catatan pembelian di Kendhi Pitoe Cafe.</b></i></h5>
@else
@foreach ($userOrder as $order)
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tanggal Pemesanan : {{ $order->created_at }}</h5>
    </div>
    <div class="card-body">
        <b>Id Pemesanan </b> : {{ $order->id }}<br>
        <b>Nomor Antrian </b> : Nomor {{ $order->no_antrian }}<br>
        <b>Status Order </b> : {{ $order->status_order }}<br>
        <b>Pembayaran </b> : {{ $order->jenis_pembayaran }}<br>
        <b>Total Harga </b> : <b>Rp. {{ $order->total_price }}</b><br>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a href=" {{ route('lacak_pesanan_detil', ['id'=>$order->id]) }}" class="btn btn-success btn-block" >
            Lihat Detail Pembelian</a>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<br>
@endforeach
@endif


@endsection