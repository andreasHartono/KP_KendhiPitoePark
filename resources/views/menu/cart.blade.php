@extends('layouts.frontend')
@section('content')
    @php
        $total = 0;
    @endphp
    <section class="checkout-wrapper pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-style-1">
                        <div class="checkout-header d-flex justify-content-between">
                            <h6 class="title">Shopping Cart</h6>
                        </div>
                        @if (session('cart'))
                            <div class="checkout-table table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class=product>Product</th>
                                            <th class=quantity>Quantity</th>
                                            <th class=price>Price</th>
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
                                                            <img src="{{ asset('images/' . $details['image']) }}"
                                                                alt="Product" height="300" width="300" />
                                                        </div>
                                                        <div class="product-content media-body">
                                                            <h5 class="title">
                                                                <a
                                                                    href="#">{{ $details['name'] }}</a>
                                                            </h5>
                                                        </div>
                                                    </div>
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
                                                    <p class="price">Rp.{{ $details['price'] * $details['quantity'] }}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout-coupon-total checkout-coupon-total-2 d-flex flex-wrap">
                                {{-- <div class="checkout-coupon">
                                    <form action="#" class="has-validation-callback">
                                        <div class="single-form form-default d-flex">
                                            <div class="form-input form">
                                                <input type="text" placeholder="Coupon Code">
                                            </div>
                                            <button class="main-btn primary-btn">Apply</button>
                                        </div>
                                    </form>
                                </div> --}}
                                <div class="checkout-total">
                                    <div class="single-total">
                                        <p class="value">Subtotal Price:</p>
                                        <p class="price">Rp.{{ $total }}</p>
                                    </div>
                                    <div class="single-total">
                                        <p class="value">Discount (-):</p>
                                        <p class="price">Rp.0</p>
                                    </div>
                                    <div class="single-total total-payable">
                                        <p class="value">Total Payable:</p>
                                        <p class="price">Rp: {{ $total }}</p>
                                    </div>
                                </div>
                                <div class="checkout-btn d-sm-flex justify-content-between">
                                    <div class="single-btn">
                                        <a href="{{ url('/') }}" class="main-btn primary-btn-border">continue
                                            shopping</a>
                                    </div>
                                    <div class="single-btn">
                                        <a href="#" class="main-btn primary-btn">Pay now</a>
                                    </div>
                                </div>
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
