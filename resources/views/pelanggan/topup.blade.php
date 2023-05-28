@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title heading-4">KENDHI PITOE WALLET</h4><br>
            <h4 class="card-title heading-6"><b id="ewalletUser">Rp. {{ Auth::user()->emoney }}</b></h4><br>
        </div>
    </div><br>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">TOP UP KENDHI PITOE WALLET</h4><br>
            <!-- <form action="" method="GET" class="was-validated"> -->
            <div class="mb-3">
                <input id="kodeVoucher" type="text" class="form-control" placeholder="Kode Voucher, misal XIASA1212"><br>
                {{-- <div class="invalid-feedback"></div>    --}}
                <button id="kirimKode" class="btn btn-success btn-block">Masukkan Kode Voucher</button><br>
                {{-- <input type="submit" value="Masukkan Kode" class="btn btn-success btn-block"> --}}
                <label class="form-label text-danger">
                    *Jika ingin melakukan Top Up Kendhi Pitoe Wallet, silahkan membeli kode top up di kasir
                </label>
            </div>
            <!-- </form> -->
        </div>
    </div><br>
</div>
@endsection
@section('javascript')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $('#kirimKode').on('click', function() {
        var kodeVoucher = $("#kodeVoucher").val();

        $.ajax({
            type: 'GET',
            url: "{{ route('isi_ewallet') }}",
            data: {
                _token: '{{ csrf_token() }}',
                kode: kodeVoucher
            },
            success: function(response) {
                
                if (response['message'] != "OK") {
                    alert(response['message']);
                } else {
                    alert("EWallet anda telah berhadil tertambah Rp.".response['nominal']);
                    $("#ewalletUser").html = esponse['nominal'];
                }

            }
        });
    });
</script>
@endsection