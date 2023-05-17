@extends('layouts.frontend')
@section('content')
<div class="container">
   <div class="card">
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
               <!-- @if(session('cart')) -->
               @foreach(session('cart') as $item)
               <tr>
                  <td class="checkout-product">
                     <div class="product-cart d-flex">
                        <div class="product-content media-body">
                           <h5 class="title">{{$item['name']}}</h5>
                        </div>
                     </div>
                  </td>
                  <td class="checkout-price">
                     <p class="price">Rp.{{$item['price']}}</p>
                  </td>
                  <td class="checkout-quantity">
                     <div class="product-quantity d-inline-flex">
                        <input type="text" value="{{ $item['quantity'] }}">
                     </div>
                  </td>
                  <td class="checkout-price">
                     <p class="price">Rp.{{$item['price'] * $item['quantity']}}</p>
                  </td>
               </tr>
               <?php $total += $item['price'];  ?>
               @endforeach
               <!-- @endif -->

            </tbody>
            <form action="" method="POST" class="was-validated">
            <tr>
                  <td>
                     <p>Tambah Catatan : &nbsp;&nbsp;<input type="text" class="form-control" placeholder="Catatan tambahan" name="catatan_tambahan"></p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>Nomor Meja : &nbsp;&nbsp;<input type="number" class="form-control" placeholder="1" name="no_meja"></p>
                     <!-- Kalo nomer meja = 0, kasik javascript keluarin input tanya lokasi -->
                  </td>
               </tr>
            <tfoot>
               
            </tfoot>
         </table>
      </div>
   </div>
   <div class="card">
      <div class="card-body">
         <h5 class="card-title">Total Harga</h5><br>
         <h6 class="card-text"> &nbsp;&nbsp;&nbsp;&nbsp; Rp.{{$total}}</h6><br>
         <!-- <p class="card-text">Punya Membership &nbsp;&nbsp; <a href="#" class="btn btn-success">Gunakan Member</a> -->
         </p>
      </div>
   </div><br>
   <div class="card">
      <div class="card-body">
         
         
            <h5 class="card-title">Nama Customer</h5>
            {{-- Ada kondisi apakah sudah login atau belum --}}
            <p class="card-text">Andrian</p><br>
            <input type="text" class="form-control" placeholder="Nama Anda" required="" nama="nama_customer">
            <div class="invalid-feedback"></div>
            
         </form>
      </div>
   </div><br>
   <div class="card">
      <div class="card-body">
      <h5 class="card-title">Metode Pembayaran</h5>
         <div class="d-grid gap-2">
            <a class="btn btn-success btn-block" href="#">E-WALLET KENDHI PITOE</a>
            <a class="btn btn-outline-success btn-block" href="{{url('/qrcode')}}">TUNAI</a>
         </div>
      </div>
   </div>
</div>
@endsection