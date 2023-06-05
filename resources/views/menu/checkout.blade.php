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

                        @foreach (session('cart') as $item)
                            <tr>
                                <td class="checkout-product">
                                    <div class="product-cart d-flex">
                                        <div class="product-content media-body">
                                            <h5 class="title">{{ $item['name'] }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="checkout-price">
                                    <p class="price">Rp.{{ number_format($item['price']) }}</p>
                                </td>
                                <td class="checkout-quantity">
                                    <div class="product-quantity d-inline-flex">
                                        <input type="text" value="{{ $item['quantity'] }}">
                                    </div>
                                </td>
                                <td class="checkout-price">
                                    <p clzass="price">Rp.{{ number_format($item['price'] * $item['quantity']) }}</p>
                                </td>
                            </tr>
                            <?php $total += $item['price']; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Harga</h5><br>
                <h6 class="card-text"> &nbsp;&nbsp;&nbsp;&nbsp; Rp.{{ number_format($total) }}</h6><br>
                <!-- <p class="card-text">Punya Membership &nbsp;&nbsp; <a href="#" class="btn btn-success">Gunakan Member</a> -->
                </p>
            </div>
        </div><br>
        <div class="card">
            <div class="card-body">

                <form action="{{ route('checkout_tunai') }}" method="POST" class="was-validated">
                    <h5 class="card-title">Nama Customer</h5>
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input name="total_price" value="{{ $total }}" type="hidden" id="total_price">
                    @auth
                        <p class="card-text">{{ Auth::user()->name }}</p><br>
                    @endauth

                    @guest
                        <input type="text" class="form-control" placeholder="Tulis Nama Anda" name="nama_customer"
                            id="nama_customer">
                    @endguest


                    <br>
                    <p>Tambah Catatan : &nbsp;&nbsp;<input type="text" class="form-control"
                            placeholder="Catatan tambahan" name="catatan_tambahan" id="catatan_tambahan"></p>
                    <br>
                    <p>Nomor Meja : &nbsp;&nbsp;<input type="number" class="form-control" value="1" name="no_meja"
                            id="no_meja"></p>
                    <!-- Kalo nomer meja = 0, kasik javascript keluarin input tanya lokasi -->


            </div>
        </div><br>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Metode Pembayaran</h5>
                <div class="d-grid gap-2">
                    <a class=" btn btn-success btn-block" href="{{ route('checkout_ewallet') }}">E-WALLET KENDHI PITOE</a>
                    <input class="btn btn-outline-success btn-block" type="submit" value="TUNAI">
                </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('javascript')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
    </script>
@endsection
