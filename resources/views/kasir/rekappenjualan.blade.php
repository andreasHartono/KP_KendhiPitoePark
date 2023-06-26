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
@if($errors->any())
<div class="alert alert-danger" role="alert"><b>{{$errors->first()}}</b></div>

@endif
<div class="row col-12">
    <form class="form-inline was-validated" action=" {{ route('rekap_pegawai') }} ">
        @csrf
        <div class="form-group">
            <label>Cari Berdasarkan Tanggal : &nbsp;</label>
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="date" class="form-control datetimepicker-input" data-target="#reservationdate" name="timeInput" id="timeInput" />
            </div>
        </div>
        <button type="submit" class="btn btn-primary ml-1 mb-2">Lakukan Pencarian Data</button>
    </form>
    @php
    $date = $tanggal;
    if($tanggal == 'hari ini')
    {
    $date = date("Y-m-d");
    }
    @endphp
    <a href="{{ route('print_rekap_pegawai',['date'=>$date]) }}" class="btn btn-success">Print Rekapan</a>
</div>


<div class="card">
    <div class="card-header">
        <h3 class="card-title"><b>Tabel penjualan menu anda pada {{ $tanggal }} :</b></h3>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="example1">
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Pemilik Menu</th>
                        <th>Jumlah Terjual</th>
                        <th>Harga Satuan</th>
                        <th>Sub Total Terjual</th>
                    </tr>
                </thead>
                <tbody id="tbody_all_rekapan">
                    @foreach ($allSoldMenu as $menu)
                    <tr>
                        <td>{{ $menu->food_name }}</td>
                        <td>{{ $menu->pemilik_name }} </td>
                        <td>{{ $menu->jumlah }}</td>
                        <td>{{ number_format($menu->price) }}</td>
                        @php
                        $subTotal = $menu->price * $menu->jumlah;
                        $grandTotal += $subTotal;
                        @endphp
                        <td>{{ number_format($subTotal) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($orderData == null)
            <hr>
            <h5><i><b>Tidak ada data penjualan pada hari ini.</b></i></h5>
            @endif
        </div>
    </div>
    <div class="card-footer">
        <h4 id="grandTotal">Grand Total : <b>Rp. {{ number_format($grandTotal) }}</b></h4>
    </div>
</div>

{{--
     @if ($orderData == null)
        <h5><i><b>Tidak ada data penjualan pada hari ini.</b></i></h5>
    @else
        @foreach ($orderData as $order)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rekap tanggal : {{ $order->created_at }} PM</h3>
</div>
<div class="card-body">
    <b>Status Order </b> : <b>{{ $order->status_order }}</b><br>
    <b>Nama Pegawai</b> : <b>{{ $order->pegawai_name }}</b><br>
    <b>Total Harga </b> : <b>Rp. {{ $order->total_price }}</b><br>
</div>

<div class="card-footer">
    <button onclick="lihatdetail({{ $order->id }})" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-lg">
        Lihat Detail Penjualan</button>
</div>

</div>

@endforeach
@endif

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Rekap Penjualan :</h4>
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
                                <td id="grandTotal">Rp.{{ $order->total_price }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
        </div>
        --}}
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
@endsection