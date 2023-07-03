<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function indexAdmin()
   {
      $cafes =  DB::table('cafes')
         ->select(
            'cafes.id',
            'cafes.name',
            'cafes.price',
            'cafes.status',
            'cafes.description',
            DB::raw('category_food.name AS nama_kategori'),
            'cafes.image',
            'cafes.created_at',
            'cafes.updated_at',
         )
         ->join('users', 'cafes.id_pemilik_menu', '=', 'users.id')
         ->join('category_food', 'cafes.category_id', '=', 'category_food.id')
         ->groupBy('cafes.id')
         ->orderBy('cafes.category_id', 'ASC')
         ->where('users.id', Auth::user()->id)
         ->get();

      if (Auth::user()->jabatan == 'owner') {
         $cafes =  DB::table('cafes')
            ->select(
               'cafes.id',
               'cafes.name',
               'cafes.price',
               'cafes.status',
               DB::raw('users.name AS pemilik_menu'),
               'cafes.description',
               DB::raw('category_food.name AS nama_kategori'),
               'cafes.image',
               'cafes.created_at',
               'cafes.updated_at',
            )
            ->join('users', 'cafes.id_pemilik_menu', '=', 'users.id')
            ->join('category_food', 'cafes.category_id', '=', 'category_food.id')
            ->groupBy('cafes.id')
            ->orderBy('cafes.category_id', 'ASC')
            ->get();
      }
      return view('kasir.datamenu', compact("cafes"));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $dataKategori = DB::table('category_food')->select('id', 'name')->get();
      return view('kasir.tambahdatamenu', compact('dataKategori'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $cafe = new Cafe();
      $destinationPath = 'images';
      $myimage = $request->image->getClientOriginalName();
      $request->image->move(public_path($destinationPath), $myimage);
      $cafe->name = $request->get('name');
      $cafe->image = $myimage;
      $cafe->price = $request->get('price');
      $cafe->status = $request->get('status');
      $cafe->id_pemilik_menu = Auth::user()->id;
      $cafe->category_id = $request->get('category_id');
      $cafe->description = $request->get('description');
      $cafe->save();
      return redirect()->route('data_menu')->with('success', Alert::success('Success Notification', 'Berhasil Tambah Menu Baru'));
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
      $dataKategori = DB::table('category_food')->select('id', 'name')->get();
      $cafes =  DB::table('cafes')
         ->select(
            'cafes.id',
            'cafes.name',
            'cafes.price',
            'cafes.status',
            'cafes.description',
            'cafes.category_id',
            'cafes.image',
         )
         ->join('users', 'cafes.id_pemilik_menu', '=', 'users.id')
         ->join('category_food', 'cafes.category_id', '=', 'category_food.id')
         ->groupBy('cafes.id')
         ->orderBy('cafes.category_id', 'ASC')
         ->where('users.id', Auth::user()->id)
         ->Where('cafes.id', $id)
         ->get();
      // dd($cafes);
      return view('kasir.ubahdatamenu', compact('cafes', 'dataKategori'));
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
      $cafe = Cafe::find($id);
      $destinationPath = 'images';
      $myimage = $request->image->getClientOriginalName();
      $request->image->move(public_path($destinationPath), $myimage);
      $cafe->name = $request->get('name');
      $cafe->image = $myimage;
      $cafe->price = $request->get('price');
      $cafe->status = $request->get('status');
      $cafe->category_id = $request->get('category_id');
      $cafe->description = $request->get('description');
      $cafe->save();
      return redirect()->route('data_menu')->with('success', Alert::success('Success Notification', 'Berhasil Ubah data Menu dengan ID Menu '.$id));
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      try {
         $cafe = Cafe::find($id);
         $cafe->delete();
         return redirect()->route('data_menu')->with('success', Alert::success('Success Notification', 'Berhasil Hapus data Menu dengan ID Menu ' . $id));
      } catch (\PDOException $e)
      {
         return redirect()->route('data_menu')->with('error', Alert::danger('Error Notification', 'Data gagal dihapus. Silahkan hubungi admin'));
      }
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
         return ["msg" => $cart[$id]['name'] . ' berhasil ditambahkan', "price" => $food->price];
      } else {
         return redirect()->route('index');
      }
   }

   public function removeFromCart(Request $request)
   {
      if (!is_null($request->id)) {
         $id = $request->id;
         $cart = session()->get('cart');

         if (isset($cart[$id])) {
            $qty = $cart[$id]['quantity']--;
            if ($qty <= 1) {
               $text = $cart[$id]['name'] . ' berhasil dihilangkan';
               unset($cart[$id]);
               session()->put('cart', $cart);
               return ["msg" => $text, "price" => $cart[$id]['price']];
            }
         }

         session()->put('cart', $cart);
         return ["msg" => $cart[$id]['name'] . ' berhasil dikurangi', "price" => $cart[$id]['price']];
         return;
      } else {
         return redirect()->route('index');
      }
   }

   public function deleteFromCart(Request $request)
   {
      if (!is_null($request->id)) {
         $id = $request->id;
         $cart = session()->get('cart');

         if (isset($cart[$id])) {
            $text = $cart[$id]['name'] . ' berhasil dihilangkan';
            $quantity = $cart[$id]['quantity'];
            $price = $cart[$id]['price'];
            unset($cart[$id]);
            session()->put('cart', $cart);

            return ["msg" => $text, "price" => $price, "qty" => $quantity];
         }
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
