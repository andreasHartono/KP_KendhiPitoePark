@extends('layouts.frontend')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<style>
    #card-cari .card-body {

        display: flex;
        justify-content: space-around;
        flex-direction: row;
    }

    #card-cari {
        margin-bottom: 12px;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.95);
        border: 0px;
    }

    .search-container {
        display: flex;
        justify-content: space-around;
        flex-direction: row;
        width: 100%;
        align-items: center;
    }

    @media screen and (max-width:992px) {
        .search-container {
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 100%;
            align-items: center;
        }

        #carilacak {
            margin-top: 8px;
        }
    }

    @media screen and (max-width:576px) {
        .search-container {
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 100%;
            align-items: center;
        }

        #carilacak {
            margin-top: 8px;
        }
    }
</style>
@endsection
@section('content')
<!-- Ini Tempat search nomor order -->
<div class="card" id="card-cari">
    <div class="card-body d-flex justify-content-center ">
        {{-- keluarin notif sukses atau gagal --}}
        <div id="msg-notif"></div>
        
       
        <form class="search-container w-100" action="{{ route('lacak_pesanan_by_nomororder')}}">
            @csrf
            <label for="nomororder" class="">Order ID :</label>
            <input id="nomororder" name='nomororder' type="text" class="form-control" value="" autofocus style="width: 75%;">
            <!-- <br>
            <label for="nomororder" class="">Nomor Meja :</label>
            <input id="nomororder" type="text" class="form-control" name="input_meja" value="" autofocus style="width: 75%;"> -->

            <input type="submit" class="btn btn-success" id="carilacak" style="width: 100px;font-size:16px;" type="button" value="Cari">
                
            </form>
       
        
    </div>
</div>



@if(isset($userOrder))


@if (count($userOrder) != 0)

@foreach ($userOrder as $order)
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tanggal Pemesanan : {{ $order->created_at }}</h5>
    </div>
    <div class="card-body">
        <b>Id Pemesanan </b> : {{ $order->order_id }}<br>
        <b>Nomor Antrian </b> : Nomor {{ $order->no_antrian }}<br>
        <b>Status Order </b> : {{ $order->status_order }}<br>
        <b>Pembayaran </b> : {{ $order->jenis_pembayaran }}<br>
        <b>Total Harga </b> : <b>Rp. {{ $order->total_price }}</b><br>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a href=" {{ route('lacak_pesanan_detil', ['id' => $order->id]) }}" class="btn btn-success btn-block">
            Lihat Detail Pembelian</a>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<br>
@endforeach
@else
<h5>Pesanan yang dicari tidak ditemukan.</h5>

@endif
@endif


@endsection
