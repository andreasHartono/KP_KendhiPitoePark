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
      dd($mejas);
      return view('menu.index', compact("mejas"));
   }

   public function generate($id)
   {
      $meja = Meja::findOrFail($id);
      $meja->link = md5($id);
      $meja->save();
      $qrcode = QrCode::size(400)
         ->format('png')
         ->merge('template/assets/images/pitoe.png')
         ->errorCorrection('M')
         ->generate(route('order.generate', ['hash' => $meja->link]));
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
      //return view('owner.generatemeja', compact('qrcode'));
   }

   public function generateSignedUrl(string $hash)
   {
      $mejaModel = Meja::where('link', $hash)->firstOrFail();
      $hashCode = md5(random_bytes(8));
      session(['hash' => $hashCode, 'meja' => $mejaModel]);
      //eturn redirect(route('order.index', ['hash' => $hashCode]));
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
      //
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
