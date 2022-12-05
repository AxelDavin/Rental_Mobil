<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Mobil::all();

        return response()->json([
            "message" => "Load Data Berhasil",
            "data" => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Mobil::create([
            "merek" => $request->merek,
            "tipe" => $request->tipe,
            "deskripsi" => $request->deskripsi,
            "no_plat" => $request->no_plat,
            "rilis" => $request->rilis
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
        $data = Mobil::find($id);
        if($data){
            return $data;
        }else{
            return ["message" => "Data Tidak Ditemukan"];
        }
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
        $data = Mobil::find($id);
        if($data){
            $data->merek = $request->merek ? $request->merek : $data->merek;
            $data->tipe = $request->tipe ? $request->tipe : $data->tipe;
            $data->deskripsi = $request->deskripsi ? $request->deskripsi : $data->deskripsi;
            $data->no_plat = $request->no_plat ? $request->no_plat : $data->no_plat;
            $data->rilis = $request->rilis ? $request->rilis : $data->rilis;
            $data->save();

            return $data;
        }else{
            return ["message" => "Data  Tidak  Ditemukan"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Mobil::find($id);
        if($data){
            $data->delete();
            return ["message" => "Data Berhasil Di Hapus"];
        }else{
            return ["message" => "Data Tidak Ditemukan"];
        }
    }
}
