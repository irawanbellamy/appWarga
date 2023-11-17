<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
use Intervention\Image\Facades\Image;
use App\Models\Pengaduan;
use App\Models\LacakPengaduan;
use Illuminate\Support\Facades\Crypt;

class ComplaintController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = DB::table('pengaduans')->get();
        return view('UserPengaduan.index', [
            'no'    => $no,
            'data'  => $data
        ]);
    }

    public function create(){
        return view('UserPengaduan.create');
    }

    public function store(Request $request)
    {
        // insert to Pengaduan
        $request->validate([
            'complaint_type'    => 'required',
            'description'       => 'required',
            'attachment'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ID Pengaduan
        $id = 'COM' . date('YmdHis');
        // status
        $status = "Posting";

        $user = auth()->user()->name;
        $input = ([
            'complaint_id'      => $id,
            'complaint_type'    => $request['complaint_type'],
            'description'       => $request['description'],
            'status'            => $status,
            'user_input'        => $user,
        ]);
        $image = $request->file('attachment');
        // nama file
        $input['attachment'] = $id . '.' .  $image->getClientOriginalExtension();
        // folder upload image
        $destinationPath = 'upload';
        $img = Image::make($image->getRealPath());
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $input['attachment']);

        Pengaduan::create($input);

        // insert to LacakPengaduan
        $tracking_id = 'TRACK' . date('YmdHis');
        $tracking_status = "Posting";

        $input_tracking = ([
            'tracking_id'   => $tracking_id,
            'complaint_id'  => $input['complaint_id'],
            'status'        => $tracking_status,
        ]);

        LacakPengaduan::create($input_tracking);

        return redirect()->route('UserPengaduan')->with('success', 'Input pengaduan berhasil');
    }

    public function detail($complaint_id)
    {
        $no = 1;
        $decrypt = Crypt::decrypt($complaint_id);
        $data =
            DB::table('lacak_pengaduans')
            ->where('lacak_pengaduans.complaint_id', '=', $decrypt)
            ->get();
        return view('UserPengaduan.detail', [
            'no'    => $no,
            'data'  => $data,
        ]);
    }
}
