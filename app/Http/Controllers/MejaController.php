<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
      $meja = Meja::findOrFail($id);
      $meja->link = md5($id);
      $meja->save();
      $qrcode = QrCode::size(400)
         ->merge('\public\template\assets\images\pitoe.png')
         ->errorCorrection('M')
         ->generate(route('meja.generateUrl', ['hash' => $meja->link]));
      
         return view('owner.qrcodemeja', compact('qrcode'));
      }
      // buat print qr code nya
      // return response()->streamDownload(
      //    function () {
      //       echo QrCode::size(200)
      //          ->format('png')
      //          ->generate(route('order.generate', ['hash' => $meja->link]));
      //    },
      //    'qr-code.png',
      //    [
      //       'Content-Type' => 'image/png',
      //    ]
      // );
      public function generateSignedUrl(string $hash)
   {
      $mejaModel = Meja::where('link', $hash)->firstOrFail();
      $hashCode = md5(random_bytes(8));
      session(['hash' => $hashCode, 'meja' => $mejaModel]);
      return redirect(route('order.index', ['hash' => $hashCode]));
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
      return back();
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
