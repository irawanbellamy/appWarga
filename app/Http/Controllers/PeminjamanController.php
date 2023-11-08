<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index(){
        $asset = DB::table('assets')->where('is_eligible', '1')->get();
        return view('assetWarga.peminjamanAsset', [
            'asset' => $asset
        ]);
    }

    public function store(Request $request){
        $data = $request->all();

        dd($data);
    }
}
