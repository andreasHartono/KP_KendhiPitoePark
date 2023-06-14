<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Dapur</title>
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
                <h4>Kendhi Pitoe Park</h4>
                <small> Kali Jaten, Selotapak, Kec. Trawas, Kabupaten Mojokerto, Jawa Timur</small>
            </div>
            <div class="card-body">
                <b>No Meja : </b> <span class="font-weight-bold">12</span><br>
                <b>Nama Pelanggan : </b> Andre<br>
                <b>Nama Kasir : </b> Agus<br>
                <b>Tanggal Transaksi : </b> 30 Mei 2023 12:30:00<br>
                <hr>
                <h3>Menu yang Dipesan</h3>
                <div class="row">
                    <div class="col-8"><b>Nasi Goreng</b></div>
                    <div class="col-4"><b>1</b></div>
                </div><br>
                <div class="row">
                    <div class="col-8"><b>Kentang Goreng</b></div>
                    <div class="col-4"><b>2</b></div>
                </div><br>
                <div class="row">
                    <div class="col-8"><b>Es Teh</b></div>
                    <div class="col-4"><b>3</b></div>
                </div><br>
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
