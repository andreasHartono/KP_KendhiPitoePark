{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('template/assets/images/pitoe.png') }}" type="image/png">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div class="card">
        <div class="card-body mx-4">
            <div class="container">
                <p class="my-5 mx-5" style="font-size: 30px;">Thank for your purchase</p>
                <div class="row">
                    <ul class="list-unstyled">
                        <li class="text-black">John Doe</li>
                        <li class="text-muted mt-1"><span class="text-black">Invoice</span> #12345</li>
                        <li class="text-black mt-1">April 17 2021</li>
                    </ul>
                    <hr>
                    <div class="col-xl-10">
                        <p>Pro Package</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end">$199.00
                        </p>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Consulting</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end">$100.00
                        </p>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Support</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end">$10.00
                        </p>
                    </div>
                    <hr style="border: 2px solid black;">
                </div>
                <div class="row text-black">

                    <div class="col-xl-12">
                        <p class="float-end fw-bold">Total: $10.00
                        </p>
                    </div>
                    <hr style="border: 2px solid black;">
                </div>
                <div class="text-center" style="margin-top: 90px;">
                    <a><u class="text-info">View in browser</u></a>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                </div>

            </div>
        </div>
    </div>  
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
</body>

</html> --}}
@extends('layouts.auth')
@section('content')
    <div class="card card-outline">
        <div class="card-header text-center">
            <img src="{{ asset('template/assets/images/pitoe.png') }}" alt="logo" height="150" width="150">
        </div>
        <div class="card-body">
            <b>No Meja : </b> <span class="font-weight-bold">12</span><br>
            <b>Nama Pelanggan : </b> Andre<br>
            <b>Nama Kasir : </b> Agus<br>
            <b>Tanggal Transaksi : </b> 30 Mei 2023 12:30:00<br>
            <b>Metode Pembayaran : </b> <span class="font-weight-bold text-uppercase font-italic">Tunai</span><br><hr>
            <h3>Menu yang Dipesan</h3>
            <b>Nasi Goreng</b><br>
            <div class="row">
               <div class="col-8"><b>1x</b>&nbsp;&nbsp;&nbsp;15.000</div>
               <div class="col-4"><b>Rp. 15.000</b></div>
            </div>
            <b>Kentang Goreng</b><br>
            <div class="row">
               <div class="col-8"><b>2x</b>&nbsp;&nbsp;&nbsp;10.000</div>
               <div class="col-4"><b>Rp. 20.000</b></div>
            </div>
            <b>Es Teh</b><br>
            <div class="row">
               <div class="col-8"><b>1x</b>&nbsp;&nbsp;&nbsp;5.000</div>
               <div class="col-4"><b>Rp. 5.000</b></div>
            </div><hr>
            <h3>Rincian Pembayaran</h3>
            <div class="row">
               <div class="col-8"><b>Total Harga</b></div>
               <div class="col-4"><b>Rp. 40.000</b></div>
            </div>
            <div class="row">
               <div class="col-8"><b>Kendhi Pitoe E-Wallet</b></div>
               <div class="col-4"><b>Rp. 40.000</b></div>
            </div><br>
            <div class="row">
               <div class="col-8"><b>Harga Tunai</b></div>
               <div class="col-4"><b>Rp. 50.000</b></div>
            </div>
            <div class="row">
               <div class="col-8"><b>Harga Kembali</b></div>
               <div class="col-4"><b>Rp. 10.000</b></div>
            </div><hr>
            <span class="text-center">
               <h4>Matur Nuwun sampun</h4>
               <h5>Rawuh ing</h5>
               <h3>Kendhi Pitoe Park</h3>
            </span>
        </div>
    </div>
@endsection
