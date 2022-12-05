<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Mobil;
use Carbon\Carbon;
//use Auth;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rent::all();

        return response()->json([
            "message" => "Load Data Berhasil",
            "data" => $data
        ], 200);
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
        $customer_id = Auth::id();
        $customer_name = Auth::user()->name;

        $mobil_id = $request->mobil_id;
        $mobil_model = Mobil::where('id', $mobil_id)->value('model');

        $rent_price = Mobil::where('id', $mobil_id)->value('rent_price');

        $rent_start = $request->rent_start;
        $rent_duration = $request->rent_duration;

        $rent_end = Carbon::create($rent_start);
        $rent_end = $rent_end->addDays($rent_duration);
        $rent_end->format('Y-m-d');

        $data = Rent::create([
            "customer_id" => $customer_id,
            "mobil_id" => $mobil_id,
            "customer_name" => $customer_name,
            "mobil_model" => $mobil_model,
            "rent_price" => $rent_price,
            "rent_duration" => $rent_duration,
            "rent_start" => $rent_start,
            "rent_end" => $rent_end
        ]);
        return response()->json([
            "message" => "Data Berhasil Di Tambah",
            "data" => $data
        ], 201);
        


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Rent::find($id);
        if($data){
            return $data;
        }else{
            return ["message" => "Data Tidak Ditemukan"];
        }
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
        $data = Rent::find($id);
        if($data){
            $data->delete();
            return ["message" => "Data Berhasil Di Hapus"];
        }else{
            return ["message" => "Data Tidak Ditemukan"];
        }
    }
}
