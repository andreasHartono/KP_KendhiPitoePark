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
      // Store a string into the variable which
      // need to be Encrypted
      // $url = "http://127.0.0.1:8000/kendhipitoe/";
      // $simple_string = $id;  
      // $ciphering = "AES-128-CTR";
      // //$iv_length = openssl_cipher_iv_length($ciphering);
      // $options = 0;
      // // Non-NULL Initialization Vector for encryption
      // $encryption_iv = '1234567891011121';
      // // Store the encryption key
      // $encryption_key = "KendhiPitoe";
      // // Use openssl_encrypt() function to encrypt the data
      // $encryption = openssl_encrypt(
      //    $simple_string,
      //    $ciphering,
      //    $encryption_key,
      //    $options,
      //    $encryption_iv
      // );      

      // $urlQrMeja = $url.$encryption;

      // $idMeja = $id;
      // $meja = Meja::findOrFail($id);
      // $meja->link = $urlQrMeja;
      // $meja->save();
      // $qrcode = QrCode::size(500)
      //    ->format('png')
      //    ->merge(public_path('images/pitoe.png'), 0.5, true)
      //    ->errorCorrection('M')
      //    ->generate(route('meja.generateUrl', ['hash' => $meja->link]));

      

      // $pdf = PDF::loadView('owner.printqrcode', ['qrcode' => $qrcode])->setOptions(['defaultFont' => 'sans-serif']);
      // $name = 'qrcode-meja ' . $idMeja . '.pdf';
      // Alert::success('Success Notification', 'Berhasil membuat QR Code dengan nomor meja ' . $idMeja);
      // return $pdf->stream($name);
      // return view('owner.qrcodemeja', compact('urlQrMeja'));
   }

   public function generateSignedUrl(string $idEncrypt)
   {
      
      // $ciphering = "AES-128-CTR";
      // $options = 0;
      // $encryption_iv = '1234567891011121';
      // $encryption_key = "KendhiPitoe";
      // $decryption = openssl_decrypt(
      //    $idEncrypt,
      //    $ciphering,
      //    $encryption_key,
      //    $options,
      //    $encryption_iv
      // );
      $url = "http://127.0.0.1:8000/kendhipitoe/".$idEncrypt;
      
      $mejaModel = Meja::where('link', '=' , $url)->get();      
      // $hashCode = Crypt::encrypt(random_bytes(8));
      session(['meja' => $mejaModel[0]->no_meja]);

      // session(['hash' => $hashCode, 'meja' => $mejaModel]);
      return redirect(route('index'));
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
      if (count($cart) == 0) {
         return redirect()->route('index')->withErrors(['Tidak ada menu pada keranjang. Mohon pilih menu untuk dimasukkan ke keranjang.']);;
      }
      return view('menu.checkout', compact(['noMejaMax']));
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
      $url = "http://127.0.0.1:8000/kendhipitoe/";
      $no_meja = $request->no_meja;  
      $ciphering = "AES-128-CTR";
      //$iv_length = openssl_cipher_iv_length($ciphering);
      $options = 0;
      // Non-NULL Initialization Vector for encryption
      $encryption_iv = '1234567891011121';
      // Store the encryption key
      $encryption_key = "KendhiPitoe";
      // Use openssl_encrypt() function to encrypt the data
      $encryption = openssl_encrypt(
         $no_meja,
         $ciphering,
         $encryption_key,
         $options,
         $encryption_iv
      );      

      $urlQrMeja = $url.$encryption;

      $meja = new Meja;
      $meja->no_meja = $no_meja;
      $meja->no_meja_encrypt = $encryption;
      $meja->link = $urlQrMeja;
      $meja->save();
      return redirect()->back()->with('success', Alert::success('Success Notification', 'Berhasil membuat meja baru dengan nomor meja ' . $request->no_meja));
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
   public function destroy($id)
   {
      try {
         $meja = Meja::find($id);
         $noMeja = $meja->no_meja;
         $meja->delete();
         return redirect()->route('data_menu')->with('success', Alert::success('Success Notification', 'Berhasil Hapus data Meja nomor ' . $noMeja));
      } catch (\PDOException $e)
      {
         return redirect()->route('data_menu')->with('error', Alert::danger('Error Notification', 'Data gagal dihapus. Silahkan hubungi admin'));
      }
      
   }
}
