@extends('layouts.admin')
@section('title')
   Pemilik
@endsection
@section('content-header')
   <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe <small>Rekap Penjualan Menu</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Rekap Penjualan Menu</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
   <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rekap Hari Kamis, 25 Mei 2023 04:04:23 PM</h3>
        </div>
        <div class="card-body">
            <b>Total Transaksi Selesai</b> : <b>22</b> Transaksi<br>
            <b>Total Makanan Terjual</b> : <b>21</b>Makanan<br>
            <b>Total Minuman Terjual</b> : <b>20</b> Minuman<br>
            <b>Total Pendapatan </b> : <b>Rp. 375.000</b><br>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-lg">
                Lihat Detail Penjualan</button>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rekap Hari Kamis, 25 Mei 2023 04:04:23 PM</h3>
        </div>
        <div class="card-body">
            <b>Total Transaksi Selesai</b> : <b>22</b> Transaksi<br>
            <b>Total Makanan Terjual</b> : <b>21</b> Makanan<br>
            <b>Total Minuman Terjual</b> : <b>20</b> Minuman<br>
            <b>Total Pendapatan </b> : <b>Rp. 375.000</b><br>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-lg">
                Lihat Detail Penjualan</button>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Rekap Penjualan Kamis, 25 Mei 2023 04:04:23 PM</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                           <thead>
                              <tr>
                                 <th>Nama Menu</th>
                                 <th>Kategori Menu</th>
                                 <th>Jumlah Terjual</th>
                                 <th>Harga Satuan</th>
                                 <th>Sub Total Terjual</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Teh</td>
                                 <td>Minuman</td>
                                 <td>10 Menu</td>
                                 <td>Rp. 5.000</td>
                                 <td>Rp. 50.000</td>
                              </tr>
                           </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection