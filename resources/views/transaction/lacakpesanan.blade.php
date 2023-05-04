@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title heading-6">No Meja &nbsp;&nbsp;&nbsp; : 1 </h4><br>
                <h4 class="card-title heading-6">Nama Customer : Guest</h4><br>
                <h4 class="card-title heading-6">Total Harga &nbsp;&nbsp; : Rp. 15.000</h4><br>
                <h4 class="card-title heading-6">ID Transaksi : 08414912421</h4>
                <h4 class="card-title heading-6">Status Pesanan : <span class="text-warning">Waiting</span></h4>
            </div>
        </div><br>
        <div class="card">
            <h5 class="card-header">Item yang Dipesan</h5>
            <div class="checkout-table">
               <table class="table table-hover">
                  <thead>
                        <tr>
                           <th class=product>Product</th>
                           <th class=quantity>Quantity</th>
                           <th class=price>Price</th>
                        </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="checkout-product">
                           <div class="product-cart d-flex">
                              <div class="product-content media-body">
                                 <h5 class="title">TEH</h5>
                              </div>
                           </div>
                        </td>
                        <td class="checkout-quantity">
                           <div class="product-quantity d-inline-flex">
                              <input type="text" value="1">
                           </div>
                        </td>
                        <td class="checkout-price">
                              <p class="price">Rp.15.000</p>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rincian Pembayaran</h5><br>
                <p class="card-text">Total Harga &nbsp;&nbsp;&nbsp;&nbsp; Rp. 15.000</p>
                <p class="card-text">Metode Pembayaran &nbsp;&nbsp;&nbsp;&nbsp;<b>Tunai</b></p>
                <a href="#" class="btn btn-success btn-block">Kembali ke Halaman Utama</a>
            </div>
        </div><br>
    </div>
@endsection
