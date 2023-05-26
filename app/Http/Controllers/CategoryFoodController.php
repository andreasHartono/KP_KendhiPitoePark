<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\CategoryFood;
use Database\Seeders\CafesSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryFood::all();
        // dd($categories);
        return view('category.list', compact("categories"));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cafes= Cafe::where("category_id",$id)->get();
        $titles= DB::table('category_food')->where('id',$id)->value('name');
        $title='';
        if($titles == 'Makanan Berat') $title = 'Makanan Berat';
        else if($titles == 'Makanan Ringan') $title = 'Makanan Ringan';
        else if($titles ==  'Minuman') $title = 'Minuman';
        return view('menu.index', compact("cafes", "title"));        
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
        //
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
}
