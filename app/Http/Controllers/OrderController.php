<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cafe;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = '{"1":{"id":"1","name":"Nasi Goreng","quantity":1,"price":"15000","image":"nasigoreng.jpg"},"2":{"id":"2","name":"Es Teh","quantity":2,"price":"6000","image":"esteh.jpg"},"4":{"id":"4","name":"Mie Goreng","quantity":1,"price":"15000","image":"miegoreng.jpg"},"pelanggan":{"name":"Budi Pelanggan 1","id":4}}';
        session()->put("scanCartOrder", $cart);       
        $jsonCart = json_decode($cart);
        $pelanggan = $jsonCart->pelanggan;       
        unset($jsonCart->pelanggan);
        
        return view('transaction.validasipembayaran', compact(["jsonCart",'pelanggan']));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
    }

    public function validasiPembayaran(Request $request)
    {
        $cart = $request['cartOrder'];
        $jsonCart = json_decode($cart);
        session()->put("scanCartOrder", $jsonCart);
        $pelanggan = $jsonCart->pelanggan;
        unset($jsonCart->pelanggan);

        return view('transaction.validasipembayaran', compact(["jsonCart",'pelanggan']));        
    }

    public function goToQR()
    {
        $cart = session()->get("cart");
        $cart['pelanggan'] = ["name"=>Auth::user()->name,"id"=>Auth::user()->id];
        $cartJson = json_encode($cart);
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('/transaction.verifikasipembayaran', compact('cartJson'))->render()
        ), 200);
       
    }

    public function checkout(Request $request)
    {
        $cartScanOrder = session()->get('scanCartOrder');
        $cart = json_decode($cartScanOrder);
        $pelanggan = $cart->pelanggan;
        unset($cart->pelanggan);       

        if (is_null($cart)) {
            $msg = "Keranjang masih kosong.";
            session()->put("msg", $msg);              
            return redirect()->route('index');
        } else {
            $orders = new Order();
            $orders->keterangan = "Belum ada";
            $orders->status_order = "Processing";
            $orders->meja_id = "1";
            $orders->total_price = 0;
            $orders->no_order = 9;
            $orders->jenis_pembayaran = "Cash";
            $orders->id_pegawai_kasir = Auth::user()->id;

            $orders->save();
            $totalPrice = 0;
           
            foreach ($cart as $value) {
                
                $od = new OrderDetails();
                $od->order_id = $orders->id;
                $od->cafe_id = $value->id;
                $od->jumlah = $value->quantity;
                $od->save();
                $totalPrice += ($value->quantity * $value->price);
            }
            $orders = Order::find($orders->id);
            $orders->total_price = $totalPrice;
            $cart = null;
            session()->put("scanCartOrder", $cart);
            return redirect()->route('index');
        }
    }
}
