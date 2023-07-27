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
    @foreach($arrOrderDetil as $nama_dapur => $pesanan)

    <div class="container" style="border: 1px black solid; padding:2px;">
        <div class="header" style="margin-bottom: 30px;">
            <h3>No Order : {{ $dataOrder->order_id }}</h3>
            <span>Dapur : {{ $nama_dapur }}</span>

        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <b>
                        <li>No Meja :</li>
                        <li>Pelanggan :</li>
                        <li>Tanggal :</li>
                    </b>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li> {{ $dataOrder->no_meja }} </li>
                    <li> {{ $dataOrder->nama_pelanggan }} </li>
                    <li> {{ $dataOrder->created_at }} </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;"><b>Pesanan Menu : </b></div>
            

        </div>
        @foreach ($pesanan as $pesan)
        <div class="flex-container" style="text-align: right;">
            <div style="text-align: center;">{{ $pesan['jumlah'] }} x {{ $pesan['menu_name'] }}</div>
            
        </div>
        @endforeach
    </div>
    <br>
    @endforeach





</body>

</html>