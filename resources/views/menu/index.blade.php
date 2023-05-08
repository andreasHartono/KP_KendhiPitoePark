@extends('layouts.frontend')
@section('content')
@php $total=0; @endphp
<div class="container">
    <div class="reviews-style">
        <div class="reviews-menu">

            <ul class="breadcrumb-list-grid nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        Semua<br>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                        Minuman<br>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        Makanan<br>Ringan
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a id="specifications-tab" data-toggle="tab" href="#specifications" role="tab" aria-controls="specifications" aria-selected="false">
                        Makanan<br>Berat
                    </a>
                </li>
            </ul>
        </div>
    </div><br>
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-50">
                <h3 class="heading-4 font-weight-700">Seluruh Makanan dan Minuman</h3>
                
                <?php
                // if(!is_null(session("msg")))
                // {
                //     echo "ec 1 : ".session('msg');
                //     session()->put('msg',null);
                //     echo "ec 2:".session('msg');
                // }

                ?>
            </div>
        </div>
        @foreach ($cafes as $cafe)
        <div class="col-lg-4">
            <div class="card card-1">
                <img src="{{ asset('images/'.$cafe->image) }}" alt="menu" class="card-body card-body-1">
                <div class="card-body card-body-1">
                    <div class="text-section">
                        <h4 class="title title-1">{{ $cafe->name }}</h4>
                        <p class="card-text card-text-1">
                            {{ Str::limit(strtolower($cafe->description), 20) }}
                            <br> Ketersediaan : {{ $cafe->status }}
                        </p>
                    </div>
                    <div class="cta-section">
                        <div class="price">Rp. {{ $cafe->price }}</div>
                        <a href="{{ url('add-to-cart/' . $cafe->id) }}" class="btn btn-success">
                            <img src="{{ asset('template/assets/images/icon-svg/cart-4.svg') }}" alt="">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div><br>
        </div>
        @endforeach

    </div>
</div>
@endsection