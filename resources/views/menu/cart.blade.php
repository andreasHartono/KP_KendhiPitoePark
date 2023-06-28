@extends('layouts.frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('template/assets/tambahan/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/tambahan/boostraps.css') }}">
@endsection
@section('content')
    @php
        $total = 0;
    @endphp
    {{-- <section class="breadcrumbs-wrapper pt-50 pb-50 bg-primary-4">
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
    </section> --}}
    {{-- <section class="checkout-wrapper pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="checkout-style-1">
                        <div class="checkout-header">
                            <h6 class="title heading-4">Daftar Menu yang Dipilih</h6>
                            
                        </div> --}}
    <div class="page-content">
        <div class="card card-style">
            <div class="mb-10">
                <div id="msg-notif"></div>
                <input type="hidden" name="idmeja" id="idmeja" value="1">
            </div>
            <div class="card-content">
                @if (session('cart'))
                    @foreach (session('cart') as $id => $details)
                        @php
                            $total += $details['price'] * $details['quantity'];
                        @endphp
                        <div class="d-flex pb-2 pl-2">
                            <div class="mr-auto">
                                <img src="{{ asset('assets/images/menu/' . $details['image']) }}"
                                    class="rounded-m shadow-xl" width="110">
                            </div>
                            <div class="ml-auto w-100 pl-3">
                                <h1 class="font-23 font-700 float-left pt-2 ">{{ $details['name'] }}
                                </h1>
                                <div class="clearfix"></div>
                                <h5 class="font-14 font-600 opacity-80 pb-2"><b>Harga per
                                        Menu : </b> Rp.<b>{{ number_format($details['price']) }}</b></h5>
                                <h5 class="font-14 font-600 opacity-80 pb-2"><b>Sub Total :</b>
                                    Rp.<b>{{ number_format($details['price'] * $details['quantity']) }}</h5><br>
                            </div>
                            <div class="input-style input-style-1 mt-1">
                                <span class="input-style-1-active">Jumlah Pesan</span>
                                <input type="number" min="1" max="999" class="border-0 w-25" placeholder="1"
                                    value="{{ $details['quantity'] }}">
                            </div>
                            <button type="button" id="btnaddcart" class="btn btn-outline-success mr-1 mb-1"
                                onclick="removeFromCart('{{ $details['id'] }}')">
                                <i class="mdi mdi-minus"></i>
                            </button>
                            <button type="button" id="add" class="btn btn-outline-success mb-1"
                                onclick="addToCart('{{ $details['id'] }}')">
                                <i class="mdi mdi-plus"></i>
                            </button>
                            <a class="delete" href="#" onclick="removeFromCart('{{ $details['id'] }}')">
                                <i class="mdi mdi-delete"></i>Hapus
                            </a>
                        </div>
                    @endforeach
                    <div class="row mb-0 pl-5 pr-5">
                        <div class="col-12">
                            <div class="divider mt-3"></div>
                        </div>
                        <div class="col-6 text-left">
                            {{-- <h4>Total Pembayaran</h4> --}}
                        </div>
                        <div class="col-6 text-right mb-2">
                            <h4>Total Pembayaran : Rp.{{ number_format($total) }}</h4>
                        </div>
                        <a href="{{ route('index') }}"
                            class="mb-2 btn btn-full btn-sm rounded-sm btn-outline-success font-800 text-uppercase">
                            Lanjutkan Pilih
                            Menu</a>
                        <a href="{{ route('checkout') }}"
                            class="btn btn-full btn-sm rounded-sm btn-success font-800 text-uppercase">Proceed
                            to
                            Checkout</a>
                        <div class="col-12">
                            <div class="divider mt-3"></div>
                        </div>
                    </div>
                    {{-- <div class="card card-1 checkout-total d-flex flex-wrap">
                        <div class="card-header">
                            <h4 class="card-title">Total Pembayaran : Rp.{{ number_format($total) }}</h4>
                        </div>
                        <div class="card-body card-body-1">
                            <div class="single-btn">
                                <a href="" class="main-btn primary-btn-border"></a>
                                <a href="{{ route('checkout') }}" class="main-btn primary-btn">Checkout</a>
                            </div>
                        </div>
                    </div> --}}
            </div>
        </div>
        {{-- @if (session('cart'))
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
                                                        onclick="removeFromCart('{{ $details['id'] }}')">
                                                        <i class="mdi mdi-minus"></i>
                                                    </button>

                                                    <input type="text" value="{{ $details['quantity'] }}">

                                                    <button type="button" id="add" class="add"
                                                        onclick="addToCart('{{ $details['id'] }}')">
                                                        <i class="mdi mdi-plus"></i>
                                                    </button>
                                                </div><br><br>
                                                <a class="delete d-flex justify-content-center" href="#"
                                                    onclick="removeFromCart('{{ $details['id'] }}')">
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
                                        <a href="{{ route('index') }}" class="main-btn primary-btn-border">Lanjutkan
                                            Pilih
                                            Menu</a>
                                        <a href="{{ route('checkout') }}" class="main-btn primary-btn">Checkout</a>
                                    </div>
                                </div>
                            </div> --}}
    @else
        <div class="card">
            <div class="card-body">
                <h2 class="heading-2">Daftar Pesanan Sementara Kosong</h2><br>
                <a href="{{ route('index') }}" class="main-btn primary-btn"> <img
                        src="{{ asset('template/assets/images/icon-svg/cart-9.svg') }}" alt="logo cart">Silahkan Pilih
                    Menu</a>
            </div>
        </div>
        @endif
    </div>
    {{-- </div>
                </div>
            </div>
    </section> --}}
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

        function removeFromCart(id) {
            $.ajax({
                type: 'GET',
                url: "{{ route('removeFromCart') }}",
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
    <script src="{{ asset('template/assets/tambahan/boostraps.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/assets/tambahan/customs.js') }}" type="text/javascript"></script>
@endsection
