@extends('layouts.frontend')
@section('content')
    <div class="container">
         <div class="card">
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
                              <p class="price">Rp.10.000</p>
                        </td>
                     </tr>
                  </tbody>
                  <tfoot>
                     <tr>
                        <td>
                           <p>Tambah Catatan : &nbsp;&nbsp;<a href="#catatan" class="btn btn-outline-success">Catatan</a></p>
                        </td>
                     </tr>
                  </tfoot>
               </table>
            </div>
         </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rincian Pembayaran</h5><br>
                <p class="card-text">Total Harga &nbsp;&nbsp;&nbsp;&nbsp; Rp. 15.000,00</p><br>
                <p class="card-text">Punya Membership &nbsp;&nbsp; <a href="#" class="btn btn-success">Gunakan Member</a>
                </p>
            </div>
        </div><br>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nama Customer</h5>
                {{-- Ada kondisi apakah sudah login atau belum --}}
                <p class="card-text">Andrian</p><br>
                <form action="" method="POST" class="was-validated">
                    <input type="text" class="form-control" placeholder="Nama Anda" required="">
                    <div class="invalid-feedback"></div>
                </form>
            </div>
        </div><br>
        <div class="card">
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a class="btn btn-success btn-block" href="#">E-WALLET KENDHI PITOE</a>
                    <a class="btn btn-outline-success btn-block" href="#">TUNAI</a>
                </div>
            </div>
        </div>
    </div>
@endsection
