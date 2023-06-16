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
    <style>
        .hold-transition .content-wrapper,
        .hold-transition .main-header,
        .hold-transition .main-sidebar,
        .hold-transition .main-sidebar *,
        .hold-transition .control-sidebar,
        .hold-transition .control-sidebar *,
        .hold-transition .main-footer {
            transition: none !important;
            -webkit-animation-duration: 0s !important;
            animation-duration: 0s !important;
        }

        .login-page {
            -ms-flex-align: center;
            align-items: center;
            background-color: #e9ecef;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            height: 100vh;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .login-box {
            width: 360px;
        }

        @media (max-width: 576px) {

            .login-box {
                margin-top: .5rem;
                width: 90%;
            }
        }

        .login-box .card {
            margin-bottom: 0;
        }

        .login-card-body {
            background-color: #fff;
            border-top: 0;
            color: #666;
            padding: 20px;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 0 solid rgba(0, 0, 0, 0.125);
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1.25rem;
        }

        .text-center {
            text-align: center !important;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -7.5px;
            margin-left: -7.5px;
        }

        .col-1,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-10,
        .col-11,
        .col-12,
        .col,
        .col-auto,
        .col-sm-1,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm,
        .col-sm-auto,
        .col-md-1,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md,
        .col-md-auto,
        .col-lg-1,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg,
        .col-lg-auto,
        .col-xl-1,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl,
        .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: 7.5px;
            padding-left: 7.5px;
        }

        .col-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .col-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }

        .card-primary:not(.card-outline)>.card-header {
            background-color: #007bff;
        }

        .card-primary:not(.card-outline)>.card-header,
        .card-primary:not(.card-outline)>.card-header a {
            color: #fff;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline">
            <div class="card-header text-center">
                <img src="{{ asset('template/assets/images/pitoe.png') }}" alt="logo" height="150" width="150"
                    class="img-responsive">
                <h4>Kendhi Pitoe Park</h4>
                <small> Kali Jaten, Selotapak, Kec. Trawas, Kabupaten Mojokerto, Jawa Timur</small>
            </div>
            <div class="card-body">
                <b>No Meja : </b> <span class="font-weight-bold">{{ $dataOrder->meja_id }}</span><br>
                <b>Nama Pelanggan : </b> {{ $dataOrder->nama_pelanggan }}<br>
                <b>Nama Kasir : </b> {{ $dataOrder->nama_kasir }}<br>
                <b>Tanggal Transaksi : </b> {{ $dataOrder->created_at }}<br>
                <hr>
                <h3>Menu yang Dipesan</h3>
                @foreach ($detilOrder as $do)
                    <div class="row">
                        <div class="col-8"><b>{{ $do->nama_menu }}</b></div>
                        <div class="col-4"><b>{{ $do->jumlah }}</b></div>
                    </div>
                @endforeach
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
