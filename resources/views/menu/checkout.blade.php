@extends('layouts.frontend')
@section('content')
    <div class="container">
        @foreach (session('cart') as $item)
            <?php $total += $item['price'] * $item['quantity']; ?>
            <div class="d-flex justify-content-center">
                <div class="card card-1">
                    <div class="card-body card-body-1">
                        <div class="text-section">
                            <h4 class="title title-1">{{ $item['name'] }}</h4>
                            <p class="card-text card-text-1">
                                <b>Harga per Menu:</b><br> Rp.<b>{{ number_format($item['price']) }}</b>
                                <br><br> <b>Sub Total:</b><br>
                                Rp.<b>{{ number_format($item['price'] * $item['quantity']) }}</b>
                            </p>
                        </div>
                        <div class="cta-section">
                            <div class="checkout-quantity">
                                <div class="product-quantity d-inline-flex">
                                    Jumlah yang dipesan :
                                    <input type="text" value="{{ $item['quantity'] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
            </div><br>
        @endforeach
        <div class="d-flex justify-content-center">
            <div class="card card-1">
               <div class="card-header">
                  <h5 class="card-title">Total Harga: Rp.{{ number_format($total) }}</h5>
               </div>
                <div class="card-body card-body-1">

                    <!-- <p class="card-text">Punya Membership &nbsp;&nbsp; <a href="#" class="btn btn-success">Gunakan Member</a> -->
                    {{-- <div class="text-section"> --}}
                        
                        <hr>
                        <form action="{{ route('checkout_tunai') }}" method="POST" class="was-validated">
                           <input name="_token" value="{{ csrf_token() }}" type="hidden">
                            <input name="total_price" value="{{ $total }}" type="hidden" id="total_price">
                            <h5 class="card-title">Nama Customer</h5>
                            @auth
                                <p class="card-text">{{ Auth::user()->name }}</p><br>
                            @endauth

                            @guest
                                <input type="text" class="form-control" placeholder="Tulis Nama Anda" name="nama_customer"
                                    id="nama_customer" required>
                            @endguest
                            <p>Tambah Catatan : &nbsp;&nbsp;<input type="text" class="form-control"
                                    placeholder="Catatan tambahan" name="catatan_tambahan" id="catatan_tambahan"></p>
                            <p>Nomor Meja : &nbsp;&nbsp;<input type="number" class="form-control" value="1"
                                    name="no_meja" id="no_meja" min='1' max={{ $noMejaMax }} required></p>
                            <!-- Kalo nomer meja = 0, kasik javascript keluarin input tanya lokasi -->
                            <div class="card-body card-body-1">
                                <h5 class="card-title">Metode Pembayaran</h5>
                                <div class="d-grid gap-2">
                                    <a class=" btn btn-success btn-block" href="{{ route('checkout_ewallet') }}">E-WALLET
                                        KENDHI
                                        PITOE</a>
                                    <input class="btn btn-outline-success btn-block" type="submit" value="TUNAI">
                                </div>
                        </form>
                    {{-- </div> --}}
                </div>
            </div>
        </div><br>
    </div>
@endsection
@section('javascript')
<script>
    $.ajax({
            type: 'GET',
            url: "{{ route('removeFromCart') }}",
            data: {
                " id": id
            },
            success: function(response) {
                $('#msg-notif').html('<div class="alert alert-success" role="alert"><b>' + response +
                    '</b></div>');
                if (response.match(/dihilangkan.*/)) {
                    $('#cart_'+id).remove();
                }
            }
        })
</script>
@endsection
