<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaanAsset extends Controller
{
    public function index(){
        $no=1;
        $data = DB::table('penggunaan_assets')->get();
        return view('assetWarga.penggunaanAsset',[
            'no'   => $no,
            'data' => $data
        ]);
    }
}
