<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .container {
            width: 300px;
        }

        .header {
            margin: 0;
            text-align: center;
        }

        h2,
        p {
            margin: 0;
        }

        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1>div {
            text-align: left;
        }

        .flex-container-1 .right {
            text-align: right;
            width: 200px;
        }

        .flex-container-1 .left {
            width: 100px;
        }

        .flex-container {
            width: 300px;
            display: flex;
        }

        .flex-container>div {
            -ms-flex: 1;
            /* IE 10 */
            flex: 1;
        }

        ul {
            display: contents;
        }

        ul li {
            display: block;
        }

        hr {
            border-style: dashed;
        }

        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header" style="margin-bottom: 30px;">
            <img src="{{ asset('images/pitoe.png') }}" alt="Kendhi Pitoe Park" height="150" width="150"
                class="img-responsive">
            <h2>Kendhi Pitoe Park</h2>
            <small>Kali Jaten, Selotapak, Kec. Trawas, Kabupaten Mojokerto, Jawa Timur</small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>No Meja</li>
                    <li>Nama Pelanggan</li>
                    <li>Nama Kasir</li>
                    <li>Tanggal</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li> {{ $dataOrder->meja_id }} </li>
                    <li> {{ $dataOrder->nama_pelanggan }} </li>
                    <li> {{ $dataOrder->nama_kasir }} </li>
                    <li> {{ date('Y-m-d : H:i:s', strtotime($dataOrder->created_at)) }} </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Nama Menu</div>
            <div>Jumlah yang Dibeli</div>
        </div>
        @foreach ($detilOrder as $do)
            <div class="flex-container" style="text-align: right;">
                <div style="text-align: left;"><b>{{ $do->nama_menu }}<b></div>
                <div><b>{{ $do->jumlah }}<b></div>
            </div>
        @endforeach
        <hr>
        <div class="header" style="margin-top: 30px;">
            <p>Matur Nuwun sampun</p>
            <p>Rawuh ing</p>
            <h3>Kendhi Pitoe Park</h3>
        </div>
    </div>
</body>

</html>
