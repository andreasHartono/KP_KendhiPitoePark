
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title heading-6">No Meja &nbsp;&nbsp;&nbsp; : {{ $pelanggan->no_meja }} </h4><br>
                <h4 class="card-title heading-6">Nama Customer : {{ $pelanggan->name }}</h4><br>
                
            </div>
        </div><br>
        <div class="card">
            <h5 class="card-header">Item yang Dipesan</h5>
            <div class="checkout-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class=product>Menu yang Dipesan</th>
                            <th class=price>Harga Per Menu</th>
                            <th class=quantity>Jumlah yang Dipesan</th>
                            <th class=price>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        @foreach ($jsonCart as $item)
                            <tr>
                                <td class="checkout-product">
                                    <div class="product-cart d-flex">
                                        <div class="product-content media-body">
                                            <h5 class="title">{{ $item->name }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="checkout-price">
                                    <p class="price">Rp.{{ number_format($item->price) }}</p>
                                </td>
                                <td class="checkout-quantity">
                                   <div class="product-quantity d-inline-flex">
                                      <input type="text" value="{{ $item->quantity }}">
                                    </div>
                                 </td>
                                 <td class="checkout-price">
                                     <p class="price">Rp.{{ number_format($item->price * $item->quantity) }}</p>
                                 </td>
                            </tr>
                            <?php $total += $item->price * $item->quantity; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rincian Pembayaran</h5><br>
                <p class="card-text"><b>Total Harga &nbsp;&nbsp;&nbsp;&nbsp; Rp. {{ number_format($total) }}</b>  </p>
                <!-- <p class="card-text">Punya Membership &nbsp;&nbsp;&nbsp;&nbsp;<b>Tidak</b></p><br> -->
                <a href="{{ route('checkout_order') }}" class="btn btn-success btn-block">Validasi Pembayaran</a>
            </div>
        </div><br>
    </div>

