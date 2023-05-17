@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div id="reader" width="600px"></div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title heading-6">Petunjuk Penggunaan</h4><br>
            <p class="card-text"><b>1. Arahkan QR Code ke kotak kamera</b></p><br>
            <p class="card-text"><b>2. Tunggu hingga muncul halaman detail pembayaran</b></p><br>
            <input type="hidden" name="result" id="result">
        </div>
    </div><br>
</div>
<a href="{{ route('validasiPembayaran') }}"><button id="tes">Anggep bisa Scan</button></a>
@endsection
@section('javascript')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>

    $('#tes').on('click', function() {

        
    });



    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        console.log(`Code matched = ${decodedText}`, decodedResult);

        $.ajax({
            type: 'GET',
            url: "{{route('validasiPembayaran')}}",
            data: {
                _token: '{{ csrf_token() }}',
                cartOrder: decodedText
            },
            success: function(response) {
                alert(response);
                alert("test")
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