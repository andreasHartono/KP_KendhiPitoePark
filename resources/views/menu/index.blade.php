@extends('layouts.frontend')
@section('content')
    @php
        $total = 0;
    @endphp
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary d-lg-flex justify-content-between align-items-center">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="btn {{ $title === 'Semua Menu' ? 'btn-success' : '' }}"
                            href="{{ url('/') }}">Semua Menu</a>
                        <a class="btn {{ $title === 'Makanan Berat' ? 'btn-success' : '' }}"
                            href="{{ url('categories/1') }}">Makanan Berat</a>
                        <a class="btn {{ $title === 'Makanan Ringan' ? 'btn-success' : '' }}"
                            href="{{ url('categories/2') }}">Makanan Ringan</a>
                        <a class="btn {{ $title === 'Minuman' ? 'btn-success' : '' }}"
                            href="{{ url('categories/3') }}">Minuman</a>
                    </div>
                </div>
            </div>
        </nav><br>
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-50">
                    <h3 class="heading-4 font-weight-700">Daftar {{ $title }}</h3>

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
                        <img src="{{ asset('assets/images/menu/' . $cafe->image) }}" alt="menu"
                            class="card-body card-body-1">
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
