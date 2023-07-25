@extends('layouts.frontend')
@section('content')
    <div id="msg-notif">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert"><b>{{ $errors->first() }}</b></div>
        @endif
    </div>
    <div class="container">
        @foreach (session('cart') as $item)
            <?php $total += $item['price'] * $item['quantity']; ?>
            <div class="d-flex justify-content-center">
                <div class="card card-1" id="cart_{{ $item['id'] }}">
                    <div class="card-body card-body-1">
                        <img src="{{ asset('assets/images/menu/' . $item['image']) }}" alt="menu"
                            class="img-responsive">
                        <div class="text-section">
                            <h4 class="title title-1">{{ $item['name'] }}</h4>
                            <p class="card-text card-text-1">
                                <b>Harga per Menu:</b><br>Rp.<b>{{ $item['price'] }}</b>
                                <br>
                            </p>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="cta-section d-grid gap-2">
                            <div class="checkout-quantity">
                                <div class="text-center">Jumlah Yang dipesan: <b>{{ $item['quantity'] }}</b></div>
                                <div class="text-center">Sub Total: Rp.<b>{{ $item['price'] * $item['quantity'] }}</b></div>
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
                        <p>Nomor Meja : &nbsp;&nbsp;<input type="number" class="form-control"
                                value="{{ session('meja') }}" name="no_meja" id="no_meja" min='1'
                                max={{ $noMejaMax }} required disabled></p>

                        <!-- Kalo nomer meja = 0, kasik javascript keluarin input tanya lokasi -->
                        <div class="card-body card-body-1">
                            <h5 class="card-title">Metode Pembayaran</h5>
                            <div class="d-grid gap-2">
                                <a class=" btn btn-success btn-block" href="{{ route('checkout_ewallet') }}">E-WALLET
                                    KENDHI PITOE</a>
                                <input onclick="alertMeja()" class="btn btn-outline-success btn-block" type="submit"
                                    value="TUNAI">
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
        function alertMeja() {
            alert('Pastikan meja yang Anda tempati sekarang sesuai dengan nomor meja yang tertera.');
        }

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
                    $('#cart_' + id).remove();
                }
            }
        })
    </script>
@endsection
