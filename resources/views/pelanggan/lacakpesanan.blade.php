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
    {{-- Pake form tanpa ajax opsi 1 --}}
    {{-- <form action="#" class="needs-validation" novalidate>
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-50">
                    <div id="msg-notif"></div>
                </div>
            </div>
            <label for="cari">Cari Nomor Order</label>
            <div class="col-md-3">
                <input type="text" name="search" id="search" class="form-control" value=""
                    placeholder="Nomor Order">
            </div>
            <div class="col-md-2">
                <a href="#" name="button" class="text-white btn btn-primary form-control">Cari</a>
            </div>
        </div>
    </form> --}}
    {{-- pake ajax tapi ini carinya opsi 2--}}
    <div class="card" id="card-cari">
        <div class="card-body d-flex justify-content-center ">
            <div class="search-container w-100">
                <label for="nomororder" class="">Cari Nomor Order :</label>
                <input id="nomororder" type="text" class="form-control" name="nomororder" value="" autofocus
                    style="width: 75%;">

                <button class="btn btn-success" id="carilacak" style="width: 100px;font-size:16px;" type="button" 
                onclick="lacakPesanan()">
                    <i class="fa-solid fa-magnifying-glass" style="margin-right: 8px;"></i>Cari</button>
            </div>
        </div>
    </div>
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
                    <a href=" {{ route('lacak_pesanan_detil', ['id' => $order->id]) }}" class="btn btn-success btn-block">
                        Lihat Detail Pembelian</a>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
            <br>
        @endforeach
    @endif
@endsection