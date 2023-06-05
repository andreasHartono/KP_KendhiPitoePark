<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cafe;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;
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

        return view('transaction.validasipembayaran', compact(["jsonCart", 'pelanggan']));
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
        session()->put("scanCartOrder", $cart);
        $jsonCart = json_decode($cart);
        $pelanggan = $jsonCart->pelanggan;
        unset($jsonCart->pelanggan);

        return response()->json(array(
            'jsonCart' => $jsonCart,
            'pelanggan' => $pelanggan,
            'msg' => view('transaction.validasipembayaran', compact(["jsonCart", 'pelanggan']))->render()
        ), 200);
    }

    public function goToQR(Request $request)
    {
        $cart = session()->get("cart");
        
        if(Auth::user() == true)
        {
            $cart['pelanggan'] = ["name" => Auth::user()->name, "id" => Auth::user()->id,'no_meja'=> $request->no_meja];
        }
        else{            
            $cart['pelanggan'] = ["name" => $request->nama_customer, "id" => 99,'no_meja'=> $request->no_meja];
        }        
        
       
        $cartJson = json_encode($cart);
        
        return view('/transaction.verifikasipembayaran', compact('cartJson'));
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
            $orders->save();
            $cart = null;
            session()->put("scanCartOrder", $cart);
            return redirect()->route('scan_kasir');
        }
    }

    public function report_penjualan()
    {
        $data = $this->get_all_order_bydate(date("Y-m-d"));
        $total = $data['total'];
        $orderData = $data['orderData'];

        $allSoldMenu = $this->get_all_ordermenu(date("Y-m-d"),0);

        if ($orderData[0] == null) {
            $orderData = null;
        }


        return view('owner.reportpenjualan', compact(['orderData', 'total', 'allSoldMenu']));
    }

    public function rekap_penjualan_pegawai()
    {
        $data = $this->get_all_order_bydate(date("Y-m-d"));
        $total = $data['total'];
        $orderData = $data['orderData'];        

        if ($orderData[0] == null) {
            $orderData = null;
        }
        $allSoldMenu = $this->get_all_ordermenu(date("Y-m-d"),Auth::user()->id);

       
        
        return view('kasir.rekappenjualan', compact(['orderData', 'total','allSoldMenu']));
    
    }

    public function report_penjualan_detil(Request $request)
    {
        $orderDataDetil = DB::table('order_details')
            ->select('order_details.order_id', 'cafes.name', 'cafes.price', 'category_food.name as category_name', 'order_details.jumlah')
            ->leftJoin('cafes', 'order_details.cafe_id', '=', 'cafes.id')
            ->leftJoin('category_food', 'cafes.category_id', '=', 'category_food.id')
            ->where("order_details.order_id", '=', $request['orderId'])
            ->get();

        return $orderDataDetil;
    }

    public function get_all_order_bydate($date)
    {
        $orderData = DB::table('orders as od')
            ->select("od.*", 'u.name as pegawai_name',)
            ->leftJoin('users as u', 'od.id_pegawai_kasir', '=', 'u.id')
            ->where('od.created_at', 'like', '%' . $date . '%')
            ->get();
        $total = DB::table("orders")
            ->where('orders.created_at', 'like', '%' . $date . '%')
            ->sum("total_price");


        return ["orderData" => $orderData, "total" => $total];
    }

    public function get_all_ordermenu($date, $id_pegawai)
    {
        if ($id_pegawai == 0) 
        {
            $allSoldMenu = DB::table('order_details')
                ->select('users.name as nama_pemilik', 'cafes.name as nama_menu', 'cafes.price', DB::raw('SUM(order_details.jumlah) as jumlah'))
                ->join('cafes', 'cafes.id', '=', 'order_details.cafe_id')
                ->join('users', 'users.id', '=', 'cafes.id_pemilik_menu')
                ->groupBy('order_details.cafe_id')
                ->where('order_details.created_at', 'like', '%' . $date . '%')
                ->get();
        } 
        else 
        {
            $allSoldMenu = DB::table('order_details')
                ->select('users.name as nama_pemilik', 'cafes.name as nama_menu', 'cafes.price', DB::raw('SUM(order_details.jumlah) as jumlah'))
                ->join('cafes', 'cafes.id', '=', 'order_details.cafe_id')
                ->join('users', 'users.id', '=', 'cafes.id_pemilik_menu')
                ->groupBy('order_details.cafe_id')
                ->where([['users.id', '=', $id_pegawai], ['order_details.created_at', 'like', '%' . $date . '%']])
                ->get();
        }

        return $allSoldMenu;
    }

    
}
