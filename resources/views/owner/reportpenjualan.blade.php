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
<h4>Total penjualan hari ini : <b>Rp. {{ $total }}</b></h4>
@foreach($orderData as $order)
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Rekap tanggal : {{ $order->created_at }} PM</h3>
    </div>
    <div class="card-body">
        <b>Nama Pegawai</b> : <b>{{ $order->pegawai_name }}</b><br>
        <b>Total Harga </b> : <b>Rp. {{ $order->total_price}}</b><br>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button onclick="lihatdetail({{ $order->id }})" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-lg">
            Lihat Detail Penjualan</button>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endforeach

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
                        <tbody id="tbody_detil">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Grand Total</th>
                                <td id="grandTotal">Rp. 50.000</td>
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
@section('javascript')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    function lihatdetail(orderId) {
        $.ajax({
            type: 'GET',
            url: "{{ route('report_penjualan_detil') }}",
            data: {
                _token: '{{ csrf_token() }}',
                orderId: orderId
            },
            success: function(response) {

                var str = "";
                var grandTotal = 0;
                response.forEach(element => {
                    var subtotal = element.price * element.jumlah;
                    str += "<tr>" +
                        "<td>" + element.name + "</td>" +
                        "<td>" + element.category_name + "</td>" +
                        "<td>" + element.jumlah + " pesanan</td>" +
                        " <td>Rp." + element.price + "</td>" +
                        "<td>Rp." + subtotal + "</td>" +
                        "</tr>";
                        grandTotal += subtotal;
                });
                $("#tbody_detil").html(str);
                $("#grandTotal").html("Rp." + grandTotal);

            }
        });
    }
</script>