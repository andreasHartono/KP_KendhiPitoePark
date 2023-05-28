@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title heading-4">KENDHI PITOE WALLET</h4><br>
                <h4 class="card-title heading-6"><b>Rp. {{ Auth::user()->emoney }}</b></h4><br>
            </div>
        </div><br>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">TOP UP KENDHI PITOE WALLET</h4><br>
                <form action="" method="GET" class="was-validated">
                  <div class="mb-3">
                     <input type="text" class="form-control" placeholder="Kode Voucher, misal XIASA1212"><br>
                     {{-- <div class="invalid-feedback"></div>    --}}
                     <button class="btn btn-success btn-block">Masukkan Kode Voucher</button><br>
                     {{-- <input type="submit" value="Masukkan Kode" class="btn btn-success btn-block"> --}}
                     <label class="form-label text-danger">
                        *Jika ingin melakukan Top Up Kendhi Pitoe Wallet, silahkan membeli kode top up di kasir
                     </label>
                  </div>
                </form>
            </div>
        </div><br>
    </div>
@endsection
