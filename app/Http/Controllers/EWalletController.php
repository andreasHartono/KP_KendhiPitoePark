<?php

namespace App\Http\Controllers;

use App\Models\Ewallet;
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
        ->select('log_vouchers.*', 'pembuat.name as name_pembuat', 'pembeli.name as name_pembeli', 'pembeli.phone as phone_pembeli')
        ->join('users as pembeli','pembeli.id','=','log_vouchers.id_pembuat')
        ->join('users as pembuat','pembuat.id','=','log_vouchers.id_pembeli')
        ->get();

        // RAW SQL QUERY udah bener, tapi kok cuman dapet 1??
        //SELECT lv.*, pembuat.name as name_pembuat, pembeli.name as name_pembeli FROM log_vouchers as lv INNER JOIN users AS pembuat ON pembuat.id = lv.id_pembuat INNER JOIN users AS pembeli ON pembeli.id = lv.id_pembeli GROUP BY lv.id;

        return view('kasir.ewallet', compact("rekapVoucherTopUp"));
             
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
        $nominal = $request['nominal'];

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

    public function generateKode(Request $request)
    {
        $id_pembuat = Auth::user()->id;
        $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
        $kodeRand = '';
        foreach (array_rand($seed, 6) as $k) $kodeRand .= $seed[$k];
        $nominal = $request['nominal'];

        $voucherTopUp = new Ewallet;
        $voucherTopUp->id_pembuat = $id_pembuat;
        $voucherTopUp->kode_voucher = $kodeRand;
        $voucherTopUp->jumlah = $nominal;
        $voucherTopUp->save();

        return $kodeRand;
    }

    public function isiEwallet(Request $request)
    {
        $kode = $request['kode'];
        // return ['message'=>$kode];
        $voucherTopUp = Ewallet::where('kode_voucher', $kode);  
        if($voucherTopUp->get('terpakai') == null)
        {
            $nominal = $voucherTopUp->get('jumlah');   
            $id = $voucherTopUp->get('id');       
            
            $voucher = EWallet::find($id)->first();;
            $voucher->id_pembeli = Auth::user()->id;
            $voucher->terpakai = now();
            $voucher->save();        

            return ["message"=>"OK","nominal"=>$nominal];
        }
        else{
            return ["message"=>"Kode sudah terpakai!","nominal"=>0];
        }
        
    }
}
