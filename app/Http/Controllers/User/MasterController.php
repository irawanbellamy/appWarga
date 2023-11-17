<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Penghuni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function profile($user_id){
        $decrypt = Crypt::decrypt($user_id);
        $data = DB::select('select * from users where user_id = ?', [$decrypt]);
        // dd($data);
        return view('UserMaster.profile', [
            'data'  => $data
        ]);
    }

    public function updateProfile(Request $request, $user_id){
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

        return redirect()->route('dashboardUser')->with('success', 'Rubah password berhasil');

    }

    public function penghuni(){
        $no = 1;
        $data = Penghuni::all();
        return view('UserMaster.penghuni', [
            'no'    => $no,
            'data'  => $data,
        ]);
    }

    public function asset(){
        $no = 1;
        $data = Asset::all();
        return view('UserMaster.asset', [
            'no'    => $no,
            'data'  => $data,
        ]);
    }
}
