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
                            <div class="mb-50">
                                <div id="msg-notif"></div>
                                <input type="hidden" name="idmeja" id="idmeja" value="1">
                            </div>
                        </div>

                        <div id="contain">
                            @if (session('cart'))
                                @foreach (session('cart') as $id => $details)
                                    @php
                                        $total += $details['price'] * $details['quantity'];
                                    @endphp
                                    <div class="card card-1" id="cart_{{ $details['id'] }}">
                                        <div class="card-body card-body-1">
                                            <img src="{{ asset('assets/images/menu/' . $details['image']) }}" alt="menu"
                                                class="img-responsive">
                                            <div class="text-section">
                                                <h4 class="title title-1">{{ $details['name'] }}</h4>
                                                <p class="card-text card-text-1">
                                                    <b>Harga per Menu:</b><br>Rp.<b>{{ $details['price'] }}</b>
                                                    <br> <b>Sub Total:</b><br>
                                                    Rp.<b
                                                        id="sub_total_{{ $details['id'] }}">{{ $details['price'] * $details['quantity'] }}</b>
                                                </p>
                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <div class="cta-section d-grid gap-2">
                                                <div class="checkout-quantity">
                                                    <div class="text-center">Jumlah Yang dipesan:</div> <br>
                                                    <div class="product-quantity d-inline-flex">
                                                        <button type="button" id="sub btnaddcart" class="sub"
                                                            onclick="removeFromCart('{{ $details['id'] }}')">
                                                            <i class="mdi mdi-minus"></i>
                                                        </button>
                                                        <input type="text" value="{{ $details['quantity'] }}">
                                                        <button type="button" id="add" class="add"
                                                            onclick="addToCart('{{ $details['id'] }}')">
                                                            <i class="mdi mdi-plus"></i>
                                                        </button>
                                                    </div><br><br>
                                                    <a class="delete d-flex justify-content-center"
                                                        onclick="deleteFromCart('{{ $details['id'] }}')">
                                                        <i class="mdi mdi-delete"></i>Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                @endforeach
                                <div class="card card-1 checkout-total d-flex flex-wrap">
                                    <div class="card-header">
                                        <h4 class="card-title">Total Pembayaran : Rp. <span
                                                id="grand_total">{{ $total }}</span></h4>
                                    </div>
                                    <div class="card-body card-body-1">
                                        <div class="single-btn mb-2">
                                            <a href="{{ route('index') }}" class="main-btn primary-btn-border">Lanjutkan
                                                Pilih
                                                Menu</a>
                                            <a href="{{ route('checkout') }}" class="main-btn primary-btn">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="heading-2">Daftar Pesanan Sementara Kosong</h2><br>
                                        <a href="{{ route('index') }}" class="main-btn primary-btn"> <img
                                                src="{{ asset('template/assets/images/icon-svg/cart-9.svg') }}"
                                                alt="logo cart">Silahkan Pilih Menu</a>
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
                    $('#msg-notif').html('<div class="alert alert-success" role="alert"><b>' + response['msg'] +
                        '</b></div>');
                    var total = $('#grand_total').html() * 1;
                    total += response['price'] * 1;
                    $('#grand_total').html(total);
                    $('#sub_total_' + id).html($('#sub_total_' + id).html() * 1 + response['price'] * 1);
                }
            })
        }

        function removeFromCart(id) {
            $.ajax({
                type: 'GET',
                url: "{{ route('removeFromCart') }}",
                data: {
                    " id": id
                },
                success: function(response) {
                    $('#msg-notif').html('<div class="alert alert-success" role="alert"><b>' + response['msg'] +
                        '</b></div>');
                    if (response['msg'].match(/dihilangkan.*/)) {
                        $('#cart_' + id).remove();
                    }
                    var total = $('#grand_total').html() * 1;
                    total -= response['price'] * 1;
                    $('#grand_total').html(total);
                    $('#sub_total_' + id).html($('#sub_total_' + id).html() * 1 - response['price'] * 1);
                }
            })
        }

        function deleteFromCart(id) {
            $.ajax({
                type: 'GET',
                url: "{{ route('deleteFromCart') }}",
                data: {
                    " id": id
                },
                success: function(response) {
                    $('#msg-notif').html('<div class="alert alert-success" role="alert"><b>' + response['msg'] +
                        '</b></div>');
                    $('#cart_' + id).remove();
                    var total = $('#grand_total').html() * 1;
                    console.log(response['price'] * response['qty']);
                    total -= response['price'] * response['qty'];
                    console.log(total);
                    $('#grand_total').html(total);
                }
            })
        }
    </script>
@endsection
