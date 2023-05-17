@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title heading-6">No Meja &nbsp;&nbsp;&nbsp; : 1 </h4><br>
                <h4 class="card-title heading-6">Nama Customer : Guest</h4><br>
                <h4 class="card-title heading-6">Total Harga &nbsp;&nbsp; : Rp. 15.000,00</h4><br>
                <h4 class="card-title heading-6">ID Transaksi : 08414912421</h4>
                <h4 class="card-title heading-6">Kasir : Kasir 1</h4>
                <h4 class="card-title heading-6">Metode Pembayaran : Tunai</h4>
            </div>
        </div><br>
        <div class="card">
            <h5 class="card-header">Item yang Dipesan</h5>
            <div class="checkout-table">
               <table class="table table-hover">
                  <thead>
                        <tr>
                           <th class=product>Menu yang Dipesan</th>
                           <th class=price>Harga Per Menu</th>
                           <th class=quantity>Jumlah yang Dipesan</th>
                           <th class=price>Sub Total</th>
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
                        <td class="checkout-price">
                              <p class="price">Rp.15.000</p>
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
                <p class="card-text">Harga Tunai &nbsp;&nbsp;&nbsp;&nbsp;Rp. 20.000</p>
                <p class="card-text">Harga Kembali  &nbsp;&nbsp;&nbsp;&nbsp;Rp. 5.000</p><br>
                <a href="#" class="btn btn-success btn-block">Download Struk</a>
                <a href="#" class="btn btn-outline-success btn-block">Cetak Struk</a>
            </div>
        </div><br>
        <div class="card-body">
            <h4 class="card-title heading-3">Terima Kasih Telah Berkunjung Di Kendhi Pitoe Park</h4><br>
         </div>
    </div>
@endsection
