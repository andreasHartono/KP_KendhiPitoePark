@extends('layouts.admin')
@section('title')
    List Order
@endsection
@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Kendi Pitoe Cafe | <small>List Order</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">List Order</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Daftar Pesanan Makanan & Minuman Hari ini</b></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nomor Order</th>
                                    <th>Nomor Meja</th>
                                    <th>Status Pesanan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Menu yang Dipesan</th>
                                    <th>Harga Per Menu</th>
                                    <th>Jumlah yang Dipesan</th>
                                    <th>Sub Total</th>
                                    <th>Detail Pesanan dan Aksi Pesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>A001</td>
                                    <td>5</td>
                                    <td><span class="bg-warning">Processing</span></td>
                                    <td>Guest 1</td>
                                    <td>Nasi Goreng</td>
                                    <td>15.000</td>
                                    <td>1</td>
                                    <td>15.000</td>
                                    <td>
                                        <div class="col-md-6">
                                            <a href="#" data-toogle="modal" data-target="#modal-lg" class="btn btn-primary btn-block btn-sm"><i
                                                    class="fa fa-bell"></i> Detail Pesanan</a>
                                            <a href="#" class="btn btn-danger btn-block btn-sm"><i
                                                    class="fa fa-bell"></i> Ganti Status Pesanan</a>
                                            <a href="#" class="btn btn-success btn-block btn-sm"><i
                                                    class="fa fa-bell"></i> Cetak Nota Pelanggan</a>
                                            <a href="#" class="btn btn-warning btn-block btn-sm"><i
                                                    class="fa fa-bell"></i> Cetak Nota Dapur</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Section -->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Pesanan :</h4>
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
                            <tbody id="tbody_detil">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Grand Total</th>
                                    <td id="grandTotal">Rp10.000</td>
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
@endsection
@section('javascript')
@endsection
