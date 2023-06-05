@extends('layouts.admin')
@section('title')
Kasir
@endsection
@section('content-header')

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0"> Kendi Pitoe Cafe | <small>Scan Pembayaran</small></h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Scan Pembayaran</a></li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div id="reader" width="600px"></div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Petunjuk Penggunaan</h4><br>
            <p class="card-text"><b>1. Arahkan QR Code ke kotak kamera</b></p><br>
            <p class="card-text"><b>2. Tunggu hingga muncul halaman detail pembayaran</b></p><br>
            <input type="hidden" name="result" id="result">
        </div>
    </div><br>

</div>

<div id="validasi_pembayaran_content">

</div>
@endsection
@section('javascript')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>



    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        console.log(`Code matched = ${decodedText}`, decodedResult);

        $.ajax({
            type: 'GET',
            url: "{{ route('validasi_pembayaran') }}",
            data: {
                _token: '{{ csrf_token() }}',
                cartOrder: decodedText
            },
            success: function(response) {               
                $("#validasi_pembayaran_content").html("<h2>Validasi Pembayaran </h2>" + response.msg);
                document.getElementById("validasi_pembayaran_content").scrollIntoView();
            }
        });
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        },
        /* verbose= */
        false
    );
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
@endsection