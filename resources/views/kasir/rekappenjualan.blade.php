@extends('layouts.admin')
@section('title')
    Kasir
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe | <small>Rekap Penjualan Menu</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Rekap Penjualan Oleh Kasir A</a></li>
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
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-lg">
                Lihat Detail Seluruh Order</button>
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
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-lg">
                Lihat Detail Seluruh Order</button>
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
                            <tfoot>
                              <tr>
                                 <th colspan="4" class="text-right">Grand Total</th>
                                 <td>Rp. 50.000</td>
                              </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
