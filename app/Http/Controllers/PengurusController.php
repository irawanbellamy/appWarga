<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengurus;
use Illuminate\Support\Facades\Crypt;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $data = DB::table('penguruses')->where('is_active', '=', '1')->get();
        return view('pengurus.index', [
            'no'        => $no,
            'data'      => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nama = DB::table('users')->where('is_active', '=', '1')->get();
        return view('pengurus.create', [
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
            'job_title'         => 'required',
            'department'        => 'required',
        ]);

        $input = ([
            'name'              => $request['name'],
            'job_title'         => $request['job_title'],
            'department'        => $request['department'],
            'is_active'         => $request['is_active'],
        ]);

        Pengurus::create($input);
        return redirect()->route('pengurus.index')->with('success', 'Tambah data pengurus berhasil');
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
        $data = Pengurus::findOrFail($decrypt);
        $nama = DB::table('users')->where('is_active', '=', '1')->get();
        return view('pengurus.edit', [
            'data'  => $data,
            'nama'  => $nama,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Pengurus::find($id)->update($request->all());
        return redirect('pengurus')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
