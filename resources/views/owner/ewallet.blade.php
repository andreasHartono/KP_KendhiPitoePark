@extends('layouts.admin')
@section('title')
    Pemilik
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe <small>Rekap E-Wallet</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Rekap E-Wallet</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><b>KENDHI PITOE WALLET<b></h4><br><br>
                <h4 class="card-title"><b>Apabila Ada Pengunjung membeli kode top up</b></h4><br><br>
                <p class="card-text"><b>1. Masukkan Nominal Top Up Misal : 10000</b></p>
                <p class="card-text"><b>2. Klik Tombol BUAT KODE TOP UP</b></p>
                <p class="card-text"><b>3. Tunggu hingga muncul KODE TOP UP dan tunjukkan kepada Pengunjung</b></p>
            </div>
        </div><br>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">TOP UP KENDHI PITOE WALLET</h4><br><br>
                <form action="#" method="POST" class="was-validated">
                    <div class="mb-3">
                        <input type="number" name="nominaltopup" class="form-control" id="inputNominal"
                            placeholder="Masukkan Nominal Top Up misal : 10000"><br>
                        {{-- <div class="invalid-feedback"></div>    --}}
                        <button class="btn btn-success btn-block">BUAT KODE TOP UP</button>
                    </div>
                </form>
            </div>
        </div><br>
        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-default">
            CONTOH TAMPILAN HASIL GENERATE TOP UP
        </button><br>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Rekap Data Kendhi Pitoe E-Wallet</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama Kasir</th>
                            <th>Kode Voucher</th>
                            <th>Nama Pelanggan</th>
                            <th>No Telpon Pelanggan</th>
                            <th>Status Voucher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Agus</td>
                            <td>XIASA1212</td>
                            <td>Agung</td>
                            <td>0812914914</td>
                            <td><span class="bg-success">Sudah Digunakan</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div><br>

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
