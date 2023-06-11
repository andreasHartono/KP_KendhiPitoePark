@extends('layouts.frontend')
@section('content')
    @php
        $total = 0;
    @endphp
    <section class="breadcrumbs-wrapper pt-50 pb-50 bg-primary-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-style breadcrumbs-style-1 d-md-flex justify-content-between align-items-center">
                        <div class="breadcrumb-left">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar Menu yang Dipilih</li>
                            </ol>
                        </div>
                        <div class="breadcrumb-right">
                            <h5 class="heading-5 font-weight-500">Daftar Menu yang Dipilih</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout-wrapper pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="checkout-style-1">
                        <div class="checkout-header">
                            <h6 class="title heading-4">Daftar Menu yang Dipilih</h6>
                        </div>
                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                @php
                                    $total += $details['price'] * $details['quantity'];
                                @endphp
                                <div class="card card-1">
                                    <div class="card-body card-body-1">
                                        <img src="{{ asset('assets/images/menu/' . $details['image']) }}" alt="menu"
                                            class="img-responsive">
                                        <div class="text-section">
                                            <h4 class="title title-1">{{ $details['name'] }}</h4>
                                            <p class="card-text card-text-1">
                                                <b>Harga per Menu:</b><br>Rp.<b>{{ number_format($details['price']) }}</b>
                                                <br> <b>Sub Total:</b><br>
                                                Rp.<b>{{ number_format($details['price'] * $details['quantity']) }}</b>
                                            </p>
                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="cta-section d-grid gap-2">
                                            <div class="checkout-quantity">
                                                <div class="text-center">Jumlah Yang dipesan:</div> <br>
                                                <div class="product-quantity d-inline-flex">

                                                    <button type="button" id="sub btnaddcart" class="sub"
                                                        onclick="addToCart('{{ $details['id'] }}')">
                                                        <i class="mdi mdi-minus"></i>
                                                    </button>
                                                    <input type="text" value="{{ $details['quantity'] }}">
                                                    <button type="button" id="add" class="add">
                                                        <i class="mdi mdi-plus"></i>
                                                    </button>
                                                </div><br><br>
                                                <a class="delete d-flex justify-content-center" href="javascript:void(0)">
                                                    <i class="mdi mdi-delete"></i>Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                            @endforeach
                            <div class="card card-1 checkout-total d-flex flex-wrap">
                                <div class="card-header">
                                    <h4 class="card-title">Total Pembayaran : Rp.{{ number_format($total) }}</h4>
                                </div>
                                <div class="card-body card-body-1">
                                    <div class="single-btn">
                                        <a href="{{ route('index') }}" class="main-btn primary-btn-border">Lanjutkan Pilih
                                            Menu</a>
                                        <a href="{{ route('checkout') }}" class="main-btn primary-btn">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('javascript')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        function addToCart(id) {
            $.ajax({
                type: 'GET',
                url: "{{ route('addToCart') }}",
                data: {
                    " id": id
                },
                success: function(response) {
                    $('#msg-notif').html('<div class="alert alert-success" role="alert"><b>' + response +
                        '</b></div>');
                }
            })
        }
    </script>
@endsection
