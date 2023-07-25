<?php

namespace App\Http\Controllers;

use App\Models\Ewallet;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EWalletController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $rekapVoucherTopUp = DB::table('log_vouchers')
         ->select('log_vouchers.*', 'kasir.name as nama_kasir', 'pelanggan.name as nama_pelanggan', 'pelanggan.phone as telpon_pelanggan')
         ->leftJoin('users as kasir', 'kasir.id', '=', 'log_vouchers.id_pembuat')
         ->leftJoin('users as pelanggan', 'pelanggan.id', '=', 'log_vouchers.id_pembeli')
         ->get();

      return view('kasir.ewallet', compact('rekapVoucherTopUp'));
      
      

      
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $id_pembuat = Auth::user()->id;
      $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
      $kodeRand = '';
      foreach (array_rand($seed, 6) as $k) $kodeRand .= $seed[$k];
      $nominal = $request->nominal;

      $voucherTopUp = new Ewallet;
      $voucherTopUp->id_pembuat = $id_pembuat;
      $voucherTopUp->kode_voucher = $kodeRand;
      $voucherTopUp->jumlah = $nominal;
      $voucherTopUp->save();

      return $kodeRand;
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\Ewallet  $ewallet
    * @return \Illuminate\Http\Response
    */
   public function show(Ewallet $ewallet)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Ewallet  $ewallet
    * @return \Illuminate\Http\Response
    */
   public function edit(Ewallet $ewallet)
   {
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Ewallet  $ewallet
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Ewallet $ewallet)
   {
      $kode = $request['kode'];
      $voucherTopUp = Ewallet::find($kode);
      $voucherTopUp->id_pembeli = Auth::user()->id;
      $voucherTopUp->terpakai = time();
      $voucherTopUp->save();

      $nominal = $voucherTopUp->get('jumlah');

      return $nominal;
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Ewallet  $ewallet
    * @return \Illuminate\Http\Response
    */
   public function destroy(Ewallet $ewallet)
   {
      //
   }

   public function isiEwallet(Request $request)
   {
      $kode = $request['kode'];      

      $voucherTopUp = Ewallet::where([['kode_voucher', "=", $kode]])->get()[0];

      if ($voucherTopUp != null) {
         if (is_null($voucherTopUp->terpakai)) {
            $nominal = $voucherTopUp->jumlah;
            $id = $voucherTopUp->id;

            $voucher = EWallet::find($id);
            $voucher->id_pembeli = Auth::user()->id;
            $voucher->terpakai = now();
            $voucher->save();            

            $user = User::find(Auth::user()->id);
            $user->emoney += $nominal;
            $user->save();

            return ["message" => "OK", "emoney_now" => $user->emoney, "nominal" => $nominal];
         }
         else{
            return ["message" => "Kode sudah terpakai!", "nominal" => 0];
         }
      } else {
         return ["message" => "Tidak ada kode voucher dengan kode : " . $kode . ""];
      }
   }

   public function checkoutEwallet()
   {
      $userEmoney = Auth::user()->emoney;

      if ($userEmoney != 0) {
         $cart = session()->get('cart');

         if (is_null($cart)) {
            return redirect()->route('index')->withErrors(['Keranjang anda masih kosong.']);
         } else {

            $totalPrice = 0;
            foreach ($cart as $value) {
               $totalPrice += $value['quantity'] * $value['price'];
            }

            if ($userEmoney < $totalPrice) {
               $kekurangan = $totalPrice - $userEmoney;
               return redirect()->route('checkout')->withErrors(['msg' => "E-Wallet anda tidak mencukupi. Anda kekurangan Rp." . $kekurangan . " untuk bertransaksi menggunakan E-Wallet."]);
            } else {
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

               $orders = new Order();
               $orders->keterangan = "-";
               $orders->status_order = "Processing";
               $orders->meja_id = $noMeja;
               $orders->no_antrian = $noAntri;
               $orders->jenis_pembayaran = "E-Wallet";
               $orders->id_pelanggan = Auth::user()->id;
               $orders->nama_pelanggan = Auth::user()->name;
               $orders->order_id =  $orderId;
               $orders->total_price = $totalPrice;
               $orders->save();


               foreach ($cart as $value) {

                  $od = new OrderDetails();
                  $od->order_id = $orders->id;
                  $od->cafe_id = $value['id'];
                  $od->jumlah = $value['quantity'];
                  $od->save();
               }
               $user = User::find(Auth::user()->id);
               $user->emoney -= $totalPrice;
               $user->save();
               $cart = null;
               session()->put("cart", $cart);
               return redirect()->route('lacak_pesanan')->with('success', 'Berhasil melakukan pemesanan dengan order id : ' . $orderId);;
            }
         }
      } else {
         return redirect()->route('checkout')->withErrors(['Anda tidak memiliki saldo pada E-wallet Kendhi Pitoe anda.']);
      }
   }
}
