<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class PenghuniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $data = DB::table('penghunis')->get();
        return view('penghuni.index', [
            'no'    => $no,
            'data'  => $data,
        ]);
    }

    public function getDataPenghuni(){
        $penghuni = Penghuni::all();
        return response()->json($penghuni);
    }

    public function getDataPenghuniById($id){
        $penghuni = DB::table('penghunis')->where('id_warga', '=', $id)->get();
        return response()->json($penghuni);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penghuni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'house_block'       => 'required',
            'house_number'      => 'required',
        ]);

        $blok = $request['house_block'];
        $nomor = $request['house_number'];

        $input = ([
            'id_warga'          => "TC3" . $blok . $nomor,
            'name'              => $request['name'],
            'house_block'       => $request['house_block'],
            'house_number'      => $request['house_number'],
            'phone_number'      => $request['phone_number'],
            'status'            => $request['status'],
        ]);

        Penghuni::create($input);
        return redirect()->route('penghuni.index')->with('success', 'Tambah data warga berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Penghuni::findOrFail($decrypt);
        return view('penghuni.edit', [
            'data'  => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Penghuni::find($id)->update($request->all());
        return redirect('penghuni')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
