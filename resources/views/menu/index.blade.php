@extends('layouts.frontend')
@section('content')
@php $total=0; @endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-50">
                    <h1 class="heading-1 font-weight-700">Seluruh Makanan dan Minuman</h1>
                </div>
            </div>
        </div>
        <div class="row">
         @foreach ($cafes as $cafe)
            <div class="col-lg-6">
                <div class="product-style-7 mt-30">
                    <div class="product-image">
                        <div class="product-active">
                            <div class="product-item">
                                <img src="{{ asset('images/'.$cafe->image) }}" alt="product">
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4 class="title"><a href="#">{{ $cafe->name }}</a></h4>
                        <p>{{ Str::limit(strtolower($cafe->description), 50) }}
                           <br> Ketersediaan : {{ $cafe->status }}
                        </p>
                        <span class="price">{{ $cafe->price }}</span>
                        <a href="{{ url('add-to-cart/'.$cafe->id)}}" class="main-btn primary-btn">
                            <img src="{{ asset('template/assets/images/icon-svg/cart-4.svg') }}" alt="">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
         @endforeach
            
        </div>
    </div>
@endsection
