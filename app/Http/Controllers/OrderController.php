<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetails;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();
        dd($order);
        return view('menu.index', compact("order"));
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
        $cart = session()->get('cart');

        $orders = new Order();
        $orders->keterangan = "Belum ada";
        $orders->status_order = "Waiting";
        $orders->meja_id = "1";
        $orders->total_price = 0;
        $orders->no_order = 9;
        $orders->jenis_pembayaran = "Cash";
        $orders->acccount_id = 1;

        $orders->save();
        $totalPrice = 0;

        foreach ($cart as $value) {
            $od = new OrderDetails();
            $od->order_id = $orders->id;
            $od->cafe_id = $value['id'];
            $od->jumlah = $value['quantity'];
            $od->save();
            $totalPrice += ($value['quantity'] * $value['price']);

        }
        $orders = Order::find($orders->id);
        $orders->total_price = $totalPrice;
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
        $cart = session()->get('cart');
        foreach ($cart as $value) {
            dd($value);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
