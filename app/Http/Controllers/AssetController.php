<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Asset;
use Intervention\Image\Facades\Image;

class AssetController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = DB::table('assets')->get();
        return  view('assetWarga.index', [
            'no'    => $no,
            'data'  => $data,
        ]);
    }

    public function create()
    {
        return view('assetWarga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_name'        => 'required',
            'quantity'          => 'required',
            // 'description'       => 'required',
            // 'attachment'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ID asset
        $id = 'AS' . date('YmdHis');
        // status
        $status = "Tersedia";
        // Is active
        $is_active = 1;
        $input = ([
            'asset_id'          => $id,
            'asset_name'        => $request['asset_name'],
            'quantity'          => $request['quantity'],
            'description'       => $request['description'],
            'status'            => $status,
            'is_active'         => $is_active,
        ]);

        if($request->file('attachment') != null){

            $image = $request->file('attachment');
            // nama file
            $input['attachment'] = $id  +  $image->getClientOriginalExtension();
            // folder upload image
            $destinationPath = 'upload';
            $img = Image::make($image->getRealPath());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['attachment']);
        }

        Asset::create($input);
        return redirect()->route('asset')->with('success', 'Tambah data asset berhasil');
    }

    public function edit(string $asset_id)
    {
        $decrypt = Crypt::decrypt($asset_id);
        $data = DB::select('select * from assets where asset_id = ?', [$decrypt]);
        // dd($data);
        return view('assetWarga.edit', [
            'data'  => $data,
        ]);
    }

    public function update(Request $request, $asset_id)
    {
        
        $input = ([
            'asset_name'        => $request['asset_name'],
            'quantity'          => $request['quantity'],
            'description'       => $request['description'],
            'status'            => $request['status'],
            'is_active'         => $request['is_active'],
        ]);
        // $image = $request->file('attachment');
        // // nama file
        // $input['attachment'] = $id + $image->getClientOriginalExtension();
        // // folder upload image
        // $destinationPath = 'upload';
        // $img = Image::make($image->getRealPath());
        // $img->resize(200, 200, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath . '/' . $input['attachment']);

        Asset::where(['asset_id' => $asset_id])
            ->update([
                'asset_name'        => $input['asset_name'],
                'quantity'          => $input['quantity'],
                'description'       => $input['description'],
                'status'            => $input['status'],
                'is_active'         => $input['is_active'],
            ]);

        return redirect()->route('asset')->with('success', 'Tambah data asset berhasil');
    }
}
