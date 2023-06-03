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
                                <li class="breadcrumb-item active" aria-current="page">Keranjang Belanja</li>
                            </ol>
                        </div>
                        <div class="breadcrumb-right">
                            <h5 class="heading-5 font-weight-500">Keranjang Belanja</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout-wrapper pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-style-1">
                        <div class="checkout-header d-flex justify-content-between">
                            <h6 class="title">Keranjang Belanja</h6>
                        </div>
                        @if (session('cart'))
                            <div class="checkout-table table-responsive">
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
                                        @foreach (session('cart') as $id => $details)
                                            @php
                                                $total += $details['price'] * $details['quantity'];
                                            @endphp
                                            <tr>
                                                <td class="checkout-product">
                                                    <div class="product-cart d-flex">
                                                        <div class="product-thumb">
                                                            <img src="{{ asset('assets/images/menu/' . $details['image']) }}"
                                                                alt="Product" height="150px" width="150px" />
                                                        </div>
                                                        <div class="product-content media-body">
                                                            <h5 class="title">
                                                                {{ $details['name'] }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </td>
                                                 <td class="checkout-price">
                                                    <p class="price">Rp.{{ number_format($details['price']) }}</p>
                                                </td>
                                                <td class="checkout-quantity">
                                                    <div class="product-quantity d-inline-flex">
                                                        <button type="button" id="sub" class="sub">
                                                            <i class="mdi mdi-minus"></i>
                                                        </button>
                                                        <input type="text" value="{{ $details['quantity'] }}">
                                                        <button type="button" id="add" class="add">
                                                            <i class="mdi mdi-plus"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="checkout-price">
                                                    <p class="price">Rp.{{ number_format($details['price'] * $details['quantity']) }}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="checkout-total d-flex flex-wrap">
                                                <div class="checkout-total">
                                                    <div class="checkout-sub-total d-flex justify-content-between">
                                                        <p class="value">Total Pembayaran :</p>
                                                        <p class="price">Rp.{{ number_format($total) }}</p>
                                                    </div>
                                                    <div class="single-btn">
                                                        <a href="{{ route('index') }}"
                                                            class="main-btn primary-btn-border">Lanjutkan Pilih Menu</a>                                                            
                                                        <a href="{{ route('checkout') }}" class="main-btn primary-btn">Checkout</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            {{-- <div class="checkout-footer">
                                <div class="checkout-sub-total d-flex justify-content-between">
                                    <p class="value">Subtotal Price:</p>
                                    <p class="price">Rp.{{ $total }}</p>
                                </div>
                                <div class="checkout-btn">
                                    <a href="#" class="main-btn primary-btn-border">View
                                        Cart</a>
                                    <a href="#" class="main-btn primary-btn">Checkout</a>
                                </div>
                            </div> --}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
