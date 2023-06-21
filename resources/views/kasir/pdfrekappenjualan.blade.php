<!doctype html>
<html>
<head>
    <title>Harga Rekapan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style type="text/css">
    body {
        font-family: sans-serif;
        font-size: 10px;
    }

    .table {
        font-size: 10px;
    }

    .table tr,
    .table td {
        height: 20px;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        padding: 0 5 0 5;
    }
</style>

<body>
    <script type="text/php">
        if (isset($pdf)) {
                $pdf->page_text(60, $pdf->get_height()-35, "{{ $pemakaians[0]->nama_pelanggan }} ({{ $pemakaians[0]->kode_pelanggan }})", null, 7, array(0,0,0));
                $pdf->page_text(500, $pdf->get_height()-35, "Halaman {PAGE_NUM}/{PAGE_COUNT}", null, 7, array(0,0,0));
            }
        </script>
    <div class="container-fluid p-3">
        <div class="row" style="display: table; width:100%;">
            <div class="col-sm-1" style="display: table-cell; vertical-align: middle; width: 20%;">
                <img src="{{ asset('images/pitoe.png') }}" height="100" width="100">
            </div>
            <div class="col-sm-6" style="color: #28a745; display: table-cell; vertical-align: middle; padding-left: -30px;">
                <h5 style="font-weight: bold;">Kendhi Pitoe Park</h5>
                <h5>Kali Jaten, Selotapak, Kec. Trawas, Kabupaten Mojokerto, Jawa Timur</h5>
            </div>
        </div>
        <h3 class="text-center p-2" style="font-weight: bold; color: #28a745;">Rekap Penjualan Menu
        </h3>
        <div style="margin-bottom: -10px;">
            <div style="display: inline-block; width: 12%;">
                <p><strong>Nama Pemilik Menu</strong></p>
            </div>
            <div style="display: inline-block;">
                <p>: {{ Auth::user()->name }}</p>
            </div>
        </div>
        <div style="margin-bottom: -10px;">
            <div style="display: inline-block; width: 12%;">
                <p><strong>Tanggal Penjualan</strong></p>
            </div>
            <div style="display: inline-block;">
                <p>: {{ $tanggal }}</p>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead style="display: table-row-group;">
                <tr class="text-center">
                    <th>Nama Menu</th>
                    <th width="15%">Jumlah Menu Terjual</th>
                    <th width="15%">Harga Satuan</th>
                    <th width="15%">SubTotal Terjual</th>

                </tr>
            </thead>
            <tbody>

                @foreach($allSoldMenu as $menu)
                <tr>
                    <td>{{ $menu->food_name }}</td>
                    <td>{{ $menu->jumlah }}</td>
                    <td>Rp. {{ number_format($menu->price) }}</td>
                    @php
                    $subTotal = $menu->price * $menu->jumlah;
                    $grandTotal += $subTotal;
                    @endphp
                    <td>Rp. {{ number_format($subTotal) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right" colspan=4>Grand Total</th>
                    <td class="text-right" colspan=2>Rp. {{ number_format($grandTotal) }}</td>
                </tr>
            </tfoot>
    </div>
</body>

</html>