@extends('layouts.admin')
@section('title')
   E-Wallet
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Kasir <small>Kendhi Pitoe E-Wallet</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Kendhi Pitoe E-Wallet</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><b>KENDHI PITOE WALLET<b></h4><br><br>
                <h4 class="card-title"><b>Apabila Ada Pengunjung membeli kode top up</b></h4><br><br>
                <p class="card-text"><b>1. Klik Tombol BUAT KODE TOP UP</b></p>
                <p class="card-text"><b>2. Tunggu hingga muncul KODE TOP UP dan tunjukkan kepada Pengunjung</b></p>
            </div>
        </div><br>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">TOP UP KENDHI PITOE WALLET</h4><br>
                <form action="#" method="POST" class="was-validated">
                    <div class="mb-3">
                        {{-- <div class="invalid-feedback"></div>    --}}
                        <button class="btn btn-success btn-block">BUAT KODE TOP UP</button>
                    </div>
                </form>
            </div>
        </div><br>
        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-default">
            CONTOH TAMPILAN HASIL GENERATE TOP UP
        </button>
        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">KODE TOP UP</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h2 class="card-title">XIASA1212</h2><br>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection
