@extends('layouts.frontend')
@section('content')
@php
$total = 0;
@endphp
<div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary d-lg-flex justify-content-between align-items-center">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="btn {{ $title === 'Semua Menu' ? 'btn-success' : '' }}" href="{{ url('/') }}">Semua
                        Menu</a>
                    <a class="btn {{ $title === 'Makanan Berat' ? 'btn-success' : '' }}" href="{{ url('categories/1') }}">Makanan Berat</a>
                    <a class="btn {{ $title === 'Makanan Ringan' ? 'btn-success' : '' }}" href="{{ url('categories/2') }}">Makanan Ringan</a>
                    <a class="btn {{ $title === 'Minuman' ? 'btn-success' : '' }}" href="{{ url('categories/3') }}">Minuman</a>
                </div>
            </div>
        </div>
    </nav><br>

    <div class="row">
        <div class="col-lg-12">
            <div class="mb-50">
                <h3 class="heading-4 font-weight-700">Daftar {{ $title }}</h3>
                <div id="msg-notif">
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert"><b>{{$errors->first()}}</b></div>
                    @endif
                </div>
                <input type="hidden" name="idmeja" id="idmeja" value="1">
            </div>
        </div>
        @foreach ($cafes as $cafe)
        <div class="col-lg-6">
            <div class="card card-1">
                <div class="card-body card-body-1">
                    <img src="{{ asset('storage/menu_images/' . $cafe->image) }}" alt="menu" class="img-responsive">
                    <div class="text-section">
                        <h4 class="title title-1">{{ $cafe->name }}</h4>
                        <p class="card-text card-text-1">
                            {{ Str::limit(strtolower($cafe->description), 20) }}
                            <br> Ketersediaan:
                            @if($cafe->status == "true")
                                <b style="color: green;">Tersedia</b>
                            @else
                                <b style="color: red;">Habis</b>
                            @endif
                            &nbsp
                        </p>
                    </div>
                    <div class="cta-section">
                        <div class="price">Rp. {{ number_format($cafe->price) }}</div>
                        <input type="hidden" name="idMenu" id="idmenu" value="{{ $cafe->id }}">

                        @if($cafe->status == "true")
                        <button onclick="addToCart('{{ $cafe->id }}'); " id="btnaddcart" class="btn btn-success">
                            <img src="{{ asset('template/assets/images/icon-svg/cart-9.svg') }}" alt="">
                            Pesan Sekarang
                        </button>
                        @else
                        <button onclick="addToCart('{{ $cafe->id }}')" id="btnaddcart" class="btn btn-success" disabled>
                            <img src="{{ asset('template/assets/images/icon-svg/cart-9.svg') }}" alt="">
                            Pesan Sekarang
                        </button>
                        @endif
                    </div>
                </div>
            </div><br>
        </div>
        @endforeach
    </div>
</div>
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
            }
        })
    }
    
</script>
@endsection