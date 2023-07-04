<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use RealRashid\SweetAlert\Facades\Alert;

class MejaController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $mejas = Meja::all();
      // dd($mejas);
      return view('owner.generatemeja', compact("mejas"));
   }

   public function generate($id)
   {
      $idMeja = $id;
      $meja = Meja::findOrFail($id);
      $meja->link = Crypt::encrypt($id);
      $meja->save();
      $qrcode = QrCode::size(500)
         ->format('png')
         ->merge(public_path('images/pitoe.png'), 0.5, true)
         ->errorCorrection('M')
         ->generate(route('meja.generateUrl', ['hash' => $meja->link]));

      $pdf = PDF::loadView('owner.printqrcode', ['qrcode' => $qrcode])->setOptions(['defaultFont' => 'sans-serif']);
      $name = 'qrcode-meja ' . $idMeja . '.pdf';
      Alert::success('Success Notification', 'Berhasil membuat QR Code dengan nomor meja ' . $idMeja);
      return $pdf->stream($name);
      //return view('owner.qrcodemeja', compact('qrcode','idMeja'));
   }

   public function generateSignedUrl(string $hash)
   {
      $mejaModel = Meja::where('link', $hash)->firstOrFail();
      // $hashCode = Crypt::encrypt(random_bytes(8));
      session(['meja' => $mejaModel]);
      // session(['hash' => $hashCode, 'meja' => $mejaModel]);
      return redirect(route('cafes.index', ['meja' => $mejaModel]));
   }

   public function meja_number()
   {
      $noMeja = DB::table('mejas')
                  ->select('no_meja')
                  ->orderByDesc("no_meja")
                  ->limit(1)
                  ->get();
      $noMejaMax = $noMeja[0]->no_meja;    
      
      $cart = session()->get('cart');
      if(count($cart) == 0)
      {
         return redirect()->route('index')->withErrors(['Tidak ada menu pada keranjang. Mohon pilih menu untuk dimasukkan ke keranjang.']);;
      }
      return view ('menu.checkout',compact(['noMejaMax']));
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
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $meja = new Meja;
      $meja->no_meja = $request->no_meja;
      $meja->link = $request->link;
      $meja->save();
      return redirect()->back()->with('success', Alert::success('Success Notification', 'Berhasil membuat meja baru dengan nomor meja '.$request->no_meja));
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\Meja  $meja
    * @return \Illuminate\Http\Response
    */
   public function show(Meja $meja)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Meja  $meja
    * @return \Illuminate\Http\Response
    */
   public function edit(Meja $meja)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Meja  $meja
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Meja $meja)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Meja  $meja
    * @return \Illuminate\Http\Response
    */
   public function destroy(Meja $meja)
   {
      //
   }
}
