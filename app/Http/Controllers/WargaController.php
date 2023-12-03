<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
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
        $penghuni = DB::table('penghunis')->get();
        // dd($nama);
        return view('warga.create', [
            'penghuni'      => $penghuni,
        ]);
    }

    // public function getPenghuni($id){
    //     $penghuni = Penghuni::find($id);
    //     return response()->json([
    //         'name'  => $penghuni->name,
    //         'house_block'  => $penghuni->house_block,
    //         'house_number'  => $penghuni->house_number,
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'           => 'required',
            'name'              => 'required',
            'house_block'       => 'required',
            'house_number'      => 'required',
            'email'             => 'required|email:dns|unique:users,email',
            'password'          => 'required',
            'status'            => 'required',
        ]);

        $input = ([
            'user_id'           => $request['user_id'],
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

    public function profile($user_id)
    {
        $decrypt = Crypt::decrypt($user_id);
        $data = DB::select('select * from users where user_id = ?', [$decrypt]);
        return view('warga.profile', [
            'data'  => $data
        ]);
    }

    public function updateProfile(Request $request, $user_id)
    {
        $request->validate([
            'password'  => 'required',
        ]);

        $input = ([
            'password'        => $request['password'],
        ]);

        User::where(['user_id' => $user_id])
            ->update([
                'password'        => bcrypt($input['password']),
            ]);

        return redirect()->route('dashboard')->with('success', 'Rubah password berhasil');
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
