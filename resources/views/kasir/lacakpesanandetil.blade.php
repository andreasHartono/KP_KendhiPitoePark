@extends('layouts.admin')
@section('content')


<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title heading-6">No Meja &nbsp;&nbsp;&nbsp; : {{ $dataOrder->meja_id }} </h4><br>
            <h4 class="card-title heading-6">Nama Customer : {{ $dataOrder->nama_pelanggan }}</h4> <br>
            <h4 class="card-title heading-6">ID Transaksi : {{ $dataOrder->id }}</h4> <br>
            @if( $dataOrder->status_order == 'Processing' )
            <h4 class="card-title heading-6">Status Pesanan : <b><span class="text-warning"> {{ $dataOrder->status_order }}</span></b></h4><br>

            @elseif( $dataOrder->status_order == 'Canceled' )
            <h4 class="card-title heading-6">Status Pesanan : <b><span class="text-danger"> {{ $dataOrder->status_order }}</span></b></h4><br>

            @else
            <h4 class="card-title heading-6">Status Pesanan : <b><span class="text-success"> {{ $dataOrder->status_order }}</span></b></h4><br>
            @endif
        </div>
    </div><br>
    <div class="card">
        <h5 class="card-header">Menu yang Dipesan</h5>
        <div class="checkout-table">
            <table class="table table-hover" id="example1">
                <thead>
                    <tr>
                        <th class=product>Nama Menu</th>
                        <th class=price>Harga Per Menu</th>
                        <th class=quantity>Jumlah yang Dipesan</th>
                        <th class=price>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detilOrder as $menu)
                    <tr>
                        <td class="checkout-product">
                            <div class="product-cart d-flex">
                                <div class="product-content media-body">
                                    <h5 class="title">{{ $menu->nama_menu }}</h5>
                                </div>
                            </div>
                        </td>
                        <td class="checkout-price">
                            <p class="price">{{ $menu->price }}</p>
                        </td>
                        <td class="checkout-price">
                            <p class="price">{{ $menu->jumlah }}</p>
                        </td>
                        <td class="checkout-price">
                            <p class="price">{{ $menu->jumlah * $menu->price }}</p>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Rincian Pembayaran</h5><br>
            <h5 class="card-text">Total Harga :&nbsp;&nbsp;&nbsp;&nbsp; Rp. {{ $dataOrder->total_price }}</h5>
            <div class="card-text">Metode Pembayaran :&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $dataOrder->jenis_pembayaran }}</b></div> <br>
            <a href="javascript:history.go(-1)" class="btn btn-success btn-block">Kembali</a>
        </div>
    </div><br>
</div>
@endsection