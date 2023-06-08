<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nota Pembayaran</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('template/assets/images/pitoe.png') }}" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline">
            <div class="card-header text-center">
                <img src="{{ asset('template/assets/images/pitoe.png') }}" alt="logo" height="150" width="150">
                <H4>Kendhi Pitoe Park</H4>
                <small> Kali Jaten, Selotapak, Kec. Trawas, Kabupaten Mojokerto, Jawa Timur</small>
            </div>
            <div class="card-body">
                <b>No Meja : </b> <span class="font-weight-bold">12</span><br>
                <b>Nama Pelanggan : </b> Andre<br>
                <b>Nama Kasir : </b> Agus<br>
                <b>Tanggal Transaksi : </b> 30 Mei 2023 12:30:00<br>
                <b>Metode Pembayaran : </b> <span class="font-weight-bold text-uppercase font-italic">Tunai</span><br>
                <hr>
                <h3>Menu yang Dipesan</h3>
                <b>Nasi Goreng</b><br>
                <div class="row">
                    <div class="col-8"><b>1 x </b>&nbsp;&nbsp;&nbsp;15.000</div>
                    <div class="col-4"><b>Rp. 15.000</b></div>
                </div>
                <b>Kentang Goreng</b><br>
                <div class="row">
                    <div class="col-8"><b>2 x </b>&nbsp;&nbsp;&nbsp;10.000</div>
                    <div class="col-4"><b>Rp. 20.000</b></div>
                </div>
                <b>Es Teh</b><br>
                <div class="row">
                    <div class="col-8"><b>1 x </b>&nbsp;&nbsp;&nbsp;5.000</div>
                    <div class="col-4"><b>Rp. 5.000</b></div>
                </div>
                <hr>
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
                </div>
                <hr>
                <span class="text-center">
                    <h4>Matur Nuwun sampun</h4>
                    <h5>Rawuh ing</h5>
                    <h3>Kendhi Pitoe Park</h3>
                </span>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
