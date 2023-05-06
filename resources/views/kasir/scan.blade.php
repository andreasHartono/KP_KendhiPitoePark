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
                <p class="card-text">Total Harga &nbsp;&nbsp;&nbsp;&nbsp; Rp. 15.000</p>
                <input type="hidden" name="result" id="result">
            </div>
        </div><br>
    </div>
@endsection
@section('javascript')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript">
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            console.log(`Code matched = ${decodedText}`, decodedResult);
            alert(decodedText);
            // let id = decodedText;
            // html5QrcodeScanner.clear().then{_=> {
            //    var CSRF_TOKEN = $('meta[name="csrf_token"]').attr('content');
            //    $.ajax({
            //       url: "{{ route('validasi') }}",
            //       type: 'POST',
            //       data: {
            //          _method: 'POST',
            //          _token: CSRF_TOKEN,
            //          qr_code: id 
            //       },
            //       success: function(response) {
            //          if(response.status = 404) {
            //             Swal.fire({
            //                title: 'QR Code Tidak terdeteksi, Ingin Scan Ulang ?',
            //                confirmButtonText: 'Ya, scan ulang',
            //                denyButtonText: 'CANCEL',
            //             }).then(result) => {
            //                if(result.isConfirmed) {
            //                   location.reload();
            //                } else if(result.isDismissed) {
            //                   console.log("deny");
            //                }
            //             }
            //          } else {
                        
            //          }
            //       }
            //    })
            // }}
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false
         );
         html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
