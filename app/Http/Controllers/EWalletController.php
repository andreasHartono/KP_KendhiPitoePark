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
      return redirect()->route('index');
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

      $voucherTopUp = Ewallet::where([['kode_voucher', "=", $kode], ["terpakai", '=', null]])->get()[0];

      if ($voucherTopUp != null) {
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

      return ["message" => "Kode sudah terpakai!", "nominal" => 0];
   }

   public function checkoutEwallet()
   {
      $userEmoney = Auth::user()->emoney;

      if ($userEmoney != 0) {
         $cart = session()->get('cart');

         if (is_null($cart)) {
            $msg = "Keranjang masih kosong.";
            session()->put("msg", $msg);
            return redirect()->route('index');
         } else {

            $totalPrice = 0;
            foreach ($cart as $value) {
               $totalPrice += ($value->quantity * $value->price);
            }

            if ($userEmoney < $totalPrice) {
               $kekurangan = $totalPrice - $userEmoney;
               return redirect()->route('pelanggan_topup', Compact(['msg' => "E-Wallet anda tidak mencukupi. Anda kekurangan Rp." . $kekurangan . " untuk bertransaksi menggunakan E-Wallet."]));
            } else {
               $orders = new Order();
               $orders->keterangan = "Belum ada";
               $orders->status_order = "Processing";
               $orders->meja_id = "1";
               $orders->total_price = 0;
               $orders->no_order = 9;
               $orders->jenis_pembayaran = "Cash";
               $orders->id_pegawai_kasir = Auth::user()->id;

               // $orders->save();


               foreach ($cart as $value) {

                  $od = new OrderDetails();
                  //  $od->order_id = $orders->id;
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
      }
   }
}
