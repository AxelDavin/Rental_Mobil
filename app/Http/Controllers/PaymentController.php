<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Rent;
use Carbon\Carbon;
use Auth;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Payment::all();

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
        $rent_id = $request->rent_id;

        $customer_id = Rent::where('id', $rent_id)->value('customer_id');
        $customer_name = Rent::where('id', $rent_id)->value('customer_name');
        $price = Rent::where('id', $rent_id)->value('rent_price');

        $payment_date = Carbon::now();

        $data = Payment::create([
            "rent_id" => $request->rent_id,
            "customer_id" => $request->customer_id,
            "customer_name" => $request->customer_name,
            "price" => $request->price,
            "payment_date" => $request->payment_date,
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
        $data = Payment::find($id);
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
        $data = Payment::find($id);
        if($data){
            $data->delete();
            return ["message" => "Data Berhasil Di Hapus"];
        }else{
            return ["message" => "Data Tidak Ditemukan"];
        }
    }
}
