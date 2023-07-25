
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order Id : {{ $pelanggan->order_id }}</h4><br>
                <h4 class="card-title">No Meja &nbsp;&nbsp;&nbsp; : {{ $pelanggan->no_meja }} </h4><br>
                <h4 class="card-title">Nama Customer : {{ $pelanggan->name }}</h4><br>              
                <h4 class="card-title">Catatan : {{ $pelanggan->keterangan }}</h4><br>
            </div>
        </div><br>
        <div class="card">
            <h5 class="card-header">Item yang Dipesan</h5>
            <table class="table table-hover" id="example1">
                <thead>
                    <tr>
                        <th>Menu yang Dipesan</th>
                        <th>Harga Per Menu</th>
                        <th>Jumlah yang Dipesan</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    @foreach ($jsonCart as $item)
                        <tr>
                            <td>
                                <h5 class="title">{{ $item->name }}</h5>
                            </td>
                            <td>
                                <p>Rp.{{ number_format($item->price) }}</p>
                            </td>
                            <td><input disabled type="text" value="{{ $item->quantity }}"></td>
                            <td>
                                <p>Rp.{{ number_format($item->price * $item->quantity) }}</p>
                            </td>
                        </tr>
                        <?php $total += $item->price * $item->quantity; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rincian Pembayaran</h5><br>
                <p class="card-text"><b>Total Harga &nbsp;&nbsp;&nbsp;&nbsp; Rp. {{ number_format($total) }}</b> </p>
                <!-- <p class="card-text">Punya Membership &nbsp;&nbsp;&nbsp;&nbsp;<b>Tidak</b></p><br> -->
                <a href="{{ route('checkout_order') }}" class="btn btn-success btn-block">Validasi Pembayaran</a>
            </div>
        </div><br>
    </div>


