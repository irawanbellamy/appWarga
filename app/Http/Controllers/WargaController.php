<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $data = DB::table('users')->where('is_active', '=', '1')->get();
        return view('warga.index', [
            'no'    => $no,
            'data'  => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nama = DB::table('penghunis')->get();
        return view('warga.create', [
            'nama'      => $nama,
        ]);
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
            'email'             => 'required|email:dns|unique:users,email',
            'password'          => 'required',
            'status'            => 'required',
        ]);

        $input = ([
            'name'              => $request['name'],
            'house_block'       => $request['house_block'],
            'house_number'      => $request['house_number'],
            'phone_number'      => $request['phone_number'],
            'role'              => $request['role'],
            'email'             => $request['email'],
            'password'          => Hash::make($request['password']),
            'status'            => $request['status'],
            'is_active'         => $request['is_active'],
        ]);

        User::create($input);
        return redirect()->route('warga.index')->with('success', 'Tambah data warga berhasil');
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
        $data = User::findOrFail($decrypt);
        return view('warga.edit', [
            'data'  => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        User::find($id)->update($request->all());
        return redirect('warga')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $findId = Crypt::decrypt($id);
        User::find($findId)->delete();
        return redirect('warga')->with('success', 'Data berhasil dihapus');
    }
}
