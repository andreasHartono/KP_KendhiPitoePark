<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use RealRashid\SweetAlert\Facades\Alert;
use Mpdf\Mpdf;

class OrderController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      //$order = Order::orderBy("created_at", "desc")->get();
      if (Auth::user()) {
         $order = DB::table('orders')
            ->select("*")
            ->orderBy('created_at', 'desc')
            ->get();
         return view('kasir.listorder', compact('order'));
      } else {
         return redirect()->route("index");
      }
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
      $arrAlp = array('', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L');
      $month = date('n');
      $day = date('j');

      $lastNoAntri = Order::where('created_at', "like", "%" . date("Y-m-d") . "%")
         ->orderBy('created_at', 'desc')
         ->take(1)
         ->get('no_antrian');

      $noAntri = 1;
      if (!is_null($lastNoAntri[0]->no_antrian)) {
         $noAntri = $lastNoAntri[0]->no_antrian + 1;
      }

      $noMeja = session('meja'); //$request->no_meja;

      $orderId = $arrAlp[$month] . $day . $noAntri . $noMeja;


      if (Auth::user() == true) {
         $id_pelanggan = Auth::user()->id;
         $nama_pelanggan = Auth::user()->name;

         $cart['pelanggan'] = ["name" => Auth::user()->name, "id" => $id_pelanggan, 'no_meja' => $noMeja, 'keterangan' => $request->catatan_tambahan, 'order_id' => $orderId, 'real_order_id' => 0];
      } else {
         $id_pelanggan = null;
         $nama_pelanggan = $request->nama_customer;

         $cart['pelanggan'] = ["name" => $request->nama_customer, "id" => 99, 'no_meja' => $noMeja, 'keterangan' => $request->catatan_tambahan, 'order_id' => $orderId, 'real_order_id' => 0];
      }


      session()->put("pelanggan", $cart['pelanggan']);

      $orders = new Order();
      $orders->status_order = "Konfirmasi Pembayaran";
      $orders->keterangan = $request->catatan_tambahan;
      $orders->meja_id = $noMeja;
      $orders->id_pelanggan = $id_pelanggan;
      $orders->nama_pelanggan = $nama_pelanggan;
      $orders->total_price = 0;
      $orders->no_antrian = $noAntri;
      $orders->jenis_pembayaran = "Cash";
      $orders->order_id = $orderId;
      $orders->save();

      $cart['pelanggan']['real_order_id'] = $orders->id;
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

         $orders = DB::table("orders")
            ->select('*')
            ->where('order_id', '=', $pelanggan->order_id)
            ->get();

         $orders = Order::find($orders[0]->id);
         $orders->id_pegawai_kasir = Auth::user()->id;
         $orders->status_order = "Processing";
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
         // $orders = Order::find($pelanggan->real_order_id);
         $orders->total_price = $totalPrice;
         $orders->save();
         $cart = null;
         session()->put("scanCartOrder", $cart);
         return redirect()->route('order.index')->with('success', Alert::success('Success Notification', 'Order berhasil divalidasi'));
      }
   }

   public function report_penjualan(Request $request)
   {
      $tanggal = 'hari ini';
      if (!$request->timeInput) {
         $data = $this->get_all_order_bydate(date("Y-m-d"));
         $total = $data['total'];
         $orderData = $data['orderData'];

         $allSoldMenu = $this->get_all_ordermenu(date("Y-m-d"), 0);

         if ($orderData[0] == null) {
            $orderData = null;
         }
      } else {
         $data = $this->get_all_order_bydate($request->timeInput);
         $total = $data['total'];
         $orderData = $data['orderData'];

         $allSoldMenu = $this->get_all_ordermenu($request->timeInput, 0);
         $tanggal = $request->timeInput;

         if ($orderData[0] == null) {
            $orderData = null;
         }
      }

      return view('owner.reportpenjualan', compact(['orderData', 'total', 'allSoldMenu', 'tanggal']));
   }

   public function rekap_penjualan_pegawai(Request $request)
   {
      $tanggal = "hari ini";

      if (!$request->timeInput) {
         $data = $this->get_all_order_bydate(date("Y-m-d"));

         $orderData = $data['orderData'];

         if ($orderData[0] == null) {
            $orderData = null;
         }
         $allSoldMenu = $this->get_all_ordermenu(date("Y-m-d"), Auth::user()->id);
      } else {

         $data = $this->get_all_order_bydate($request->timeInput);

         $orderData = $data['orderData'];

         if ($orderData[0] == null) {
            $orderData = null;
         }
         $allSoldMenu = $this->get_all_ordermenu($request->timeInput, Auth::user()->id);

         $tanggal = $request->timeInput;
      }

      $failMsg = '';
      return view('kasir.rekappenjualan', compact(['orderData', 'allSoldMenu', 'tanggal', "failMsg"]));
   }

   public function print_rekap_penjualan_pegawai(Request $request)
   {
      $date = $request->date;
      $data = $this->get_all_order_bydate($date);

      $orderData = $data['orderData'];

      if ($orderData[0] == null) {
         $orderData = null;
      }

      $allSoldMenu = $this->get_all_ordermenu($date, Auth::user()->id);
      $tanggal = "tanggal " . $date;

      if ($date == date('Y-m-d')) {
         $tanggal = "hari ini";
      }

      if (!$allSoldMenu) {
         return redirect()->route('rekap_pegawai')->withErrors(['Tidak ada data penjualan menu anda hari ini']);
      }

      // $mpdf = new Mpdf(['format' => 'A4']);
      // $html = view('kasir.pdfrekappenjualan', compact(['orderData', 'allSoldMenu', 'tanggal']))->render();
      // $mpdf->WriteHTML($html);
      // $mpdf->Output('Rekap_Penjualan_Pegawai.pdf','D');
      
      return view('kasir.pdfrekappenjualan', compact(['orderData', 'allSoldMenu', 'tanggal']));
      return  redirect()->back()->with('success', Alert::success('Success Notification', 'Berhasil Print Rekap Penjualan Pelanggan'));;
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
      if ($id_pegawai == 0) {
         $allSoldMenu = DB::table('order_details')
            ->select('users.name as nama_pemilik', 'cafes.name as nama_menu', 'cafes.price', DB::raw('SUM(order_details.jumlah) as jumlah'))
            ->join('cafes', 'cafes.id', '=', 'order_details.cafe_id')
            ->join('users', 'users.id', '=', 'cafes.id_pemilik_menu')
            ->groupBy('order_details.cafe_id')
            ->where('order_details.created_at', 'like', '%' . $date . '%')
            ->get();
      } else {

         $allSoldMenu = DB::select(DB::raw("SELECT v.food_name, v.price, v.jumlah, v.id_pemilik_menu, v.pemilik_name 
         FROM (SELECT c.name as food_name, c.price, SUM(od.jumlah) as jumlah, c.id_pemilik_menu, u.name as pemilik_name
         FROM order_details as od 
         INNER JOIN cafes as c ON c.id = od.cafe_id
         INNER JOIN users as u ON c.id_pemilik_menu = u.id
         WHERE od.created_at LIKE '%" . $date . "%'
         GROUP BY c.id) as v
         WHERE v.id_pemilik_menu = " . $id_pegawai . "
         GROUP BY v.food_name"));
      }

      return $allSoldMenu;
   }

   public function ganti_status_order(Request $request)
   {
      $order = Order::find($request->orderId);
      $order->status_order = $request->status;
      $order->save();

      return "Status order dengan ID : " . $request->orderId . " berhasil terganti menjadi '$request->status'";
   }

   public function lacak_pesanan_ku()
   {
      $id = Auth::user()->id;
      $userOrder = DB::table('orders')
         ->select("*")
         ->where("id_pelanggan", "=", $id)
         ->orderBy("created_at", "desc")
         ->get();

      return view('pelanggan.lacakpesanan', compact('userOrder'));
   }

   public function lacak_pesanan_by_nomororder(Request $request)
   {
      $orderId = $request['nomororder'];
      $userOrder = DB::table('orders')
         ->select("*")
         ->where([["order_id", "=", $orderId], ['created_at', 'LIKE', '%' . date('Y-m-d') . '%']])
         ->orderBy("created_at", "desc")
         ->get();
      return view('pelanggan.lacakpesanantamu', compact('userOrder'));
   }

   public function lacak_pesanan_detil_pegawai($id)
   {
      $dataOrder = DB::table('orders')
         ->select("*")
         ->where("id", "=", $id)
         ->orderBy("created_at", "desc")
         ->get();

      $detilOrder = DB::table('order_details')
         ->select('cafes.name as nama_menu', 'cafes.price', DB::raw('SUM(order_details.jumlah) as jumlah'))
         ->join('cafes', 'cafes.id', '=', 'order_details.cafe_id')
         ->groupBy('order_details.cafe_id')
         ->where('order_details.order_id', '=', $id)
         ->get();

      $dataOrder = $dataOrder[0];

      return view('kasir.lacakpesanandetil', compact(['dataOrder', 'detilOrder']));
   }

   public function lacak_pesanan_detil($id)
   {
      // if(isset($request['orderId']))
      // {
      //    $id = $request['orderId'];
      // }      

      $dataOrder = DB::table('orders')
         ->select("*")
         ->where("id", "=", $id)
         ->orderBy("created_at", "desc")
         ->get();

      if (count($dataOrder) == 0) {
         return '<h5>Pesanan yang dicari tidak ada.</h5>';
      }

      $detilOrder = DB::table('order_details')
         ->select('cafes.name as nama_menu', 'cafes.price', DB::raw('SUM(order_details.jumlah) as jumlah'))
         ->join('cafes', 'cafes.id', '=', 'order_details.cafe_id')
         ->groupBy('order_details.cafe_id')
         ->where('order_details.order_id', '=', $id)
         ->get();

      $dataOrder = $dataOrder[0];

      return view('pelanggan.lacakpesanandetil', compact(['dataOrder', 'detilOrder']));
   }

   public function cetak_nota_pelanggan($id)
   {
      $dataOrder = DB::table('orders')
         ->select("orders.*", "users.name as nama_kasir")
         ->join('users', 'orders.id_pegawai_kasir', '=', 'users.id')
         ->where("orders.id", "=", $id)
         ->orderBy("orders.created_at", "desc")
         ->get();

      $detilOrder = DB::table('order_details')
         ->select('cafes.name as nama_menu', 'cafes.price', DB::raw('SUM(order_details.jumlah) as jumlah'))
         ->join('cafes', 'cafes.id', '=', 'order_details.cafe_id')
         ->groupBy('order_details.cafe_id')
         ->where('order_details.order_id', '=', $id)
         ->get();
      $dataOrder = $dataOrder[0];
      //    return view('transaction.invoicedapur', compact(['dataOrder', 'detilOrder', 'imagePath']));
      // $profile = CapabilityProfile::load("TM-P20");
      // $connector = new NetworkPrintConnector("IP Printer",9100);
      $connector = new WindowsPrintConnector("TM-P20");
      $print = new Printer($connector);
      $print->setJustification(Printer::JUSTIFY_CENTER);
      $print->setEmphasis(true);
      $img = EscposImage::load(public_path('images/pitoe12.png'));
      $print->graphics($img);
      $print->text("Kendhi Pitoe Park\n");
      $print->text("Kali Jaten, Selotapak, Kec. Trawas, \nKabupaten Mojokerto, Jawa Timur\n");
      $print->setEmphasis(false);
      $print->text("\n==========================================\n");
      $print->setJustification(Printer::JUSTIFY_LEFT);
      $print->setEmphasis(true);
      $print->text("No Nota : " . $dataOrder->order_id . "\n");
      $print->text("No Meja : " . $dataOrder->meja_id . "\n");
      $print->text("Nama Pelanggan : " . $dataOrder->nama_pelanggan . "\n");
      $print->text("Nama Kasir : " . $dataOrder->nama_kasir . "\n");
      $print->text("Tanggal Transaksi : " . date('Y-m-d : H:i:s', strtotime($dataOrder->created_at)) . "\n");
      $print->setEmphasis(false);
      $print->text("\n==========================================\n");
      $print->setEmphasis(false);
      foreach ($detilOrder as $do) {
         $print->setJustification(Printer::JUSTIFY_LEFT);
         $print->text($do->nama_menu . "\n");
         $print->text($do->jumlah . " x " . $do->price);
         $print->setJustification(Printer::JUSTIFY_RIGHT);
         $print->text(str_repeat(" ", 23) . 'Rp.' . number_format($do->jumlah * $do->price) . "\n");
      }
      $print->setJustification(Printer::JUSTIFY_CENTER);
      $print->text("\n==========================================\n");
      $print->setJustification(Printer::JUSTIFY_RIGHT);
      $print->setEmphasis(true);
      $print->text("Grand Total: Rp." . number_format($dataOrder->total_price) . "\n\n");
      $print->setJustification(Printer::JUSTIFY_CENTER);
      $print->setTextSize(1, 1);
      $print->text("Matur Nuwun sampun\n");
      $print->text("Rawuh ing\n");
      $print->text("Kendhi Pitoe Park");
      $print->feed(4);
      $print->close();
      return redirect()->back()->with('success', Alert::success('Success Notification', 'Berhasil Print Nota Pelanggan'));
   }

   public function cetak_nota_dapur($id)
   {
      $dataOrder = DB::table('orders')
         ->select("orders.*", "users.name as nama_kasir")
         ->join('users', 'orders.id_pegawai_kasir', '=', 'users.id')
         ->where("orders.id", "=", $id)
         ->orderBy("orders.created_at", "desc")
         ->get();

      $detilOrder = DB::table('order_details')
         ->select('cafes.name as nama_menu', 'cafes.price', DB::raw('SUM(order_details.jumlah) as jumlah'))
         ->join('cafes', 'cafes.id', '=', 'order_details.cafe_id')
         ->groupBy('order_details.cafe_id')
         ->where('order_details.order_id', '=', $id)
         ->get();
      $dataOrder = $dataOrder[0];
      //    return view('transaction.invoicepelanggan', compact(['dataOrder', 'detilOrder', 'imagePath']));
      // $profile = CapabilityProfile::load("TM-P20");
      // $connector = new NetworkPrintConnector("IP Printer",9100);
      $connector = new WindowsPrintConnector("TM-P20");
      $print = new Printer($connector);
      $print->setJustification(Printer::JUSTIFY_CENTER);
      $print->setEmphasis(true);
      $img = EscposImage::load(public_path('images/pitoe12.png'));
      $print->graphics($img);
      $print->text("Kendhi Pitoe Park\n");
      $print->text("Kali Jaten, Selotapak, Kec. Trawas, Kabupaten Mojokerto, Jawa Timur\n");
      $print->setEmphasis(false);
      $print->text("\n==========================================\n");
      $print->setJustification(Printer::JUSTIFY_LEFT);
      $print->setEmphasis(true);
      $print->text("No Nota : " . $dataOrder->order_id . "\n");
      $print->text("No Meja : " . $dataOrder->meja_id . "\n");
      $print->text("Nama Pelanggan : " . $dataOrder->nama_pelanggan . "\n");
      $print->text("Nama Kasir : " . $dataOrder->nama_kasir . "\n");
      $print->text("Tanggal Transaksi : " . date('Y-m-d : H:i:s', strtotime($dataOrder->created_at)) . "\n");
      $print->setEmphasis(false);
      $print->text("\n==========================================\n");
      $print->setEmphasis(false);
      foreach ($detilOrder as $do) {
         $print->setJustification(Printer::JUSTIFY_LEFT);
         $print->text($do->jumlah . "   x   " . $do->nama_menu . "\n");
      }
      $print->setJustification(Printer::JUSTIFY_CENTER);
      $print->text("\n==========================================\n");
      $print->setJustification(Printer::JUSTIFY_CENTER);
      $print->setEmphasis(true);
      $print->setTextSize(1, 1);
      $print->text("Matur Nuwun sampun\n");
      $print->text("Rawuh ing\n");
      $print->text("Kendhi Pitoe Park");
      $print->feed(4);
      $print->close();
      return redirect()->back()->with('success', Alert::success('Success Notification', 'Berhasil Print Nota Dapur'));
   }
}
