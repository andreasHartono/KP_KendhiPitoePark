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
    <div class="row col-12">
        <form class="form-inline was-validated" action="#">
            @csrf
            <div class="form-group">
                <label>Cari Berdasarkan Tanggal : &nbsp;</label>
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="date" class="form-control datetimepicker-input" data-target="#reservationdate" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary ml-1 mb-2">Lakukan Pencarian Data</button>
        </form><br>
    </div>
    <!-- Default box -->

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
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
                        <td>{{ $menu->nama_menu }}</td>
                        <td>{{ $menu->nama_pemilik }} </td>
                        <td>{{ $menu->jumlah }}</td>
                        <td>{{ $menu->price }}</td>
                        <td>{{ $menu->price * $menu->jumlah }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Grand Total</th>
                    <td id="grandTotal"><b>Rp. {{ $total }}</b></td>
                </tr>
            </tfoot>
        </table>
    </div>
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
                <!-- /.card-body -->
                <div class="card-footer">
                    <button onclick="lihatdetail({{ $order->id }})" class="btn btn-success btn-block"
                        data-toggle="modal" data-target="#modal-lg">
                        Lihat Detail Penjualan</button>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
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







    <!-- <div class="table-responsive">
            <table class="table table-hover table-bordered">
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
                        <td>{{ $menu->nama_menu }}</td>
                        <td>{{ $menu->nama_pemilik }} </td>
                        <td>{{ $menu->jumlah }}</td>
                        <td>{{ $menu->price }}</td>
                        <td>{{ $subTotal = $menu->price * $menu->jumlah }}</td>
                    </tr>
                    <?php
                    $grandTotal += $subTotal;
                    ?>
    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Grand Total</th>
                        <td id="grandTotal"><b>Rp. {{ $grandTotal }}</b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
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
                
                <div class="card-footer">
                    <button class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-lg">
                        Lihat Detail Penjualan</button>
                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-lg">
                        Lihat Detail Seluruh Order</button>
                </div>
                
            </div>
            
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
                
                <div class="card-footer">
                    <button class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-lg">
                        Lihat Detail Penjualan</button>
                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-lg">
                        Lihat Detail Seluruh Order</button>
                </div>
                
            </div>
            

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
                   
                </div>
                
            </div> -->
    <!-- /.modal -->
@endsection
