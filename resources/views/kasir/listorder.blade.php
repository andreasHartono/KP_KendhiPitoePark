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
        @if(session('success'))
        {{ session('sucess') }}
        @endif
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <h3>Daftar Pesanan Makanan & Minuman Hari ini</b></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>Nomor Order</th>
                                <th>Waktu Pemesanan</th>
                                <th>Nomor Meja</th>
                                <th>Status Pesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Total</th>
                                <th>Detail Pesanan dan Aksi Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $ord)
                            <tr>
                                <td>{{ $ord->id }}</td>
                                <td>{{ $ord->created_at }}</td>
                                <td>{{ $ord->meja_id }}</td>
                                <td>
                                    <form action="#" class="validated">
                                        <label for="ganti status">Ganti Status Pesanan</label>
                                        <select id="gantistatus_{{ $ord->id }}" name="gantistatus_{{ $ord->id }}" class="form-control editable">
                                            @if ($ord->status_order == 'Processing')
                                            <option value="Processing" class="bg-warning" selected>Processing</option>
                                            <option value="Done" class="bg-success">Done</option>
                                            <option value="Canceled" class="bg-danger">Canceled</option>
                                            <option value="Canceled" class="bg-danger">Konfirmasi Pembayaran</option>
                                            @elseif($ord->status_order == 'Done')
                                            <option value="Processing" class="bg-warning">Processing</option>
                                            <option value="Done" class="bg-success" selected>Done</option>
                                            <option value="Canceled" class="bg-danger">Canceled</option>
                                            <option value="Canceled" class="bg-danger">Konfirmasi Pembayaran</option>
                                            @elseif($ord->status_order == 'Canceled')
                                            <option value="Processing" class="bg-warning">Processing</option>
                                            <option value="Done" class="bg-success">Done</option>
                                            <option value="Canceled" class="bg-danger" selected>Canceled</option>
                                            <option value="Canceled" class="bg-danger">Konfirmasi Pembayaran</option>
                                            @else
                                            <option value="Processing" class="bg-warning">Processing</option>
                                            <option value="Done" class="bg-success">Done</option>
                                            <option value="Canceled" class="bg-danger">Canceled</option>
                                            <option value="Canceled" class="bg-danger" selected>Konfirmasi Pembayaran</option>
                                            @endif
                                        </select>

                                        <a onclick="ganti_status_order({{ $ord->id }})" class="btn btn-danger btn-block btn-sm"><i class="fa fa-bell"></i> Ganti Status Pesanan</a>
                                    </form>

                                </td>
                                <td>{{ $ord->nama_pelanggan }}</td>
                                <td>Rp. {{ $ord->total_price }}</td>

                                <td>
                                    <div class="col-md-6">
                                        <a href="{{ route('lacak_pesanan_detil_pegawai', ['id' => $ord->id]) }}" data-toogle="modal" data-target="#modal-lg" class="btn btn-primary btn-block btn-sm"><i class="fa fa-bell"></i>
                                            Detail Pesanan</a>

                                        <a href="{{ route('nota_pelanggan', ['id' => $ord->id]) }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-bell"></i>
                                            Cetak Nota Pelanggan</a>
                                        <a href="{{ route('nota_dapur', ['id' => $ord->id]) }}" class="btn btn-warning btn-block btn-sm"><i class="fa fa-bell"></i>
                                            Cetak Nota Dapur</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
<script>
    function ganti_status_order(orderId) {

        var val = $("#gantistatus_" + orderId).val();

        $.ajax({
            type: 'GET',
            url: "{{ route('ganti_status_order') }}",
            data: {
                _token: '{{ csrf_token() }}',
                orderId: orderId,
                status: val
            },
            success: function(response) {
                alert(response);
            }
        })
    }
</script>
@endsection