<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CafeController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $cafes = Cafe::all();
      $title = 'Semua Menu';
      return view('menu.index', compact("cafes", "title"));
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
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      //
   }

   public function cart()
   {
      return view('menu.cart');
   }

   public function addToCart(Request $request)
   {
      if (!is_null($request->id)) {
         $id = $request->id;
         $food = Cafe::find($id);
         $cart = session()->get('cart');

         if (!isset($cart[$id])) {
            $cart[$id] = [
               "id" => $id,
               "name" => $food->name,
               "quantity" => 1,
               "price" => $food->price,
               "image" => $food->image,
            ];
         } else {
            $cart[$id]['quantity']++;
         }

         session()->put('cart', $cart);
         //   return Alert::success('Pesan Menu Berhasil', $cart[$id]['name'] . ' berhasil ditambahkan');
         return $cart[$id]['name'] . ' berhasil ditambahkan';
      } else {
         return redirect()->route('index');
      }
   }
   public function increaseQtyCart(Request $request)
   {
      if (!is_null($request->id)) {
         $id = $request->id;
         $cart = session()->get('cart');
         $cart[$id]['quantity']++;
         // session()->put('cart', $cart);
         return Alert::success('Tambah Item Menu Berhasil', 'kuantitas item menu berhasil ditambahkan');
      } else {
         return Alert::danger('Gagal Tambah Item', 'silahkan cek ketersediaan menu di halaman menu, bila tidak ada silahkan tanya kepada pelayan cafe');
      }
   }

   public function decreaseQtyCart(Request $request)
   {
      if (!is_null($request->id)) {
         $id = $request->id;
         $cart = session()->get('cart');
         $cart[$id]['quantity']--;
         // session()->put('cart', $cart);
         return Alert::success('Kurang Item Menu Berhasil', 'kuantitas item menu berhasil dikurangkan');
      } else {
         return Alert::danger('Gagal Kurang Item', 'silahkan cek ketersediaan menu di halaman menu, bila tidak ada silahkan tanya kepada pelayan cafe');
      }
   }

   public function deleteQtyCart(Request $request)
   {
      if (!is_null($request->id)) {
         $id = $request->id;
         $cart = session()->get('cart');
         unset($cart);
         return Alert::success('Item Menu Berhasil dihapus', 'kuantitas item menu berhasil dihapus');
      } else {
         return Alert::danger('Gagal Hapus Item', '');
      }
   }
}
