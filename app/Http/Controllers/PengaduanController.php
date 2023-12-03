<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LacakPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;

class PengaduanController extends Controller
{
    public function index()
    {
        $no = 1;
        $data = DB::table('pengaduans')->get();
        return view('pengaduan.index', [
            'no'    => $no,
            'data'  => $data
        ]);
    }

    public function pengaduanPdf(){
        $no = 1;
        $data = DB::table('pengaduans')->get();
        $pdf = Pdf::loadView('pengaduan.pengaduanPdf', [
            'no'            => $no,
            'data'          => $data,
        ])->setPaper('A3', 'landscape');
        return $pdf->stream();
    }

    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        // insert to Pengaduan
        $request->validate([
            'complaint_type'    => 'required',
            'description'       => 'required',
            'attachment'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
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
        $img->resize(500, 500, function ($constraint) {
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

        return redirect()->route('pengaduan')->with('success', 'Input pengaduan berhasil');
    }

    public function edit($complaint_id)
    {
        $decrypt = Crypt::decrypt($complaint_id);
        $data = DB::select('select * from pengaduans where complaint_id = ?', [$decrypt]);
        return view('pengaduan.edit', [
            'data'  => $data,
        ]);
    }

    public function update(Request $request, $complaint_id)
    {

        $id = 'EXC' . date('YmdHis');
        $input = ([
            'status'                => $request['status'],
            'followup_date'         => $request['followup_date'],
            'followup_note'         => $request['followup_note'],
            'reject_date'           => $request['reject_date'],
            'reject_note'           => $request['reject_note'],
            'execution_date'        => $request['execution_date'],
            'execution_note'        => $request['execution_note'],
            'execution_attachment'  => $request->file('execution_attachment'),
            'user_update'           => Auth()->user()->name,
            'finish_date'           => $request['finish_date'],
            'finish_note'           => $request['finish_note'],
        ]);

        if ($input['execution_attachment'] != null) {
            $image = $request->file('execution_attachment');
            // nama file
            $input['execution_attachment'] = $id . '.' .  $image->getClientOriginalExtension();
            // folder upload image
            $destinationPath = 'upload';
            $img = Image::make($image->getRealPath());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['execution_attachment']);
        }

        if ($input['status'] == "Reject") {
            Pengaduan::where(['complaint_id' => $complaint_id])
                ->update([
                    'status'                => $input['status'],
                    'reject_date'           => $input['reject_date'],
                    'reject_note'           => $input['reject_note'],
                    'user_update'           => $input['user_update'],
                ]);


            // insert to LacakPengaduan
            $tracking_id = 'TRACK' . date('YmdHis');

            $input_tracking = ([
                'tracking_id'   => $tracking_id,
                'complaint_id'  => $complaint_id,
                'status'        => $input['status'],
            ]);

            LacakPengaduan::create($input_tracking);

            return redirect()->route('pengaduan')->with('success', 'Update Pengaduan berhasil');
        } elseif ($input['status'] == "Diteruskan") {
            Pengaduan::where(['complaint_id' => $complaint_id])
                ->update([
                    'status'                => $input['status'],
                    'followup_date'         => $input['followup_date'],
                    'followup_note'         => $input['followup_note'],
                    'user_update'           => $input['user_update'],
                ]);
            // insert to LacakPengaduan
            $tracking_id = 'TRACK' . date('YmdHis');

            $input_tracking = ([
                'tracking_id'   => $tracking_id,
                'complaint_id'  => $complaint_id,
                'status'        => $input['status'],
            ]);

            LacakPengaduan::create($input_tracking);

            return redirect()->route('pengaduan')->with('success', 'Update Pengaduan berhasil');
        } elseif ($input['status'] == "Diproses") {
            Pengaduan::where(['complaint_id' => $complaint_id])
                ->update([
                    'status'                => $input['status'],
                    'execution_date'        => $input['execution_date'],
                    'execution_note'        => $input['execution_note'],
                    'execution_attachment'  => $input['execution_attachment'],
                    'user_update'           => $input['user_update'],
                ]);
            // insert to LacakPengaduan
            $tracking_id = 'TRACK' . date('YmdHis');

            $input_tracking = ([
                'tracking_id'   => $tracking_id,
                'complaint_id'  => $complaint_id,
                'status'        => $input['status'],
            ]);

            LacakPengaduan::create($input_tracking);

            return redirect()->route('pengaduan')->with('success', 'Update Pengaduan berhasil');
        } elseif ($input['status'] == "Selesai") {
            Pengaduan::where(['complaint_id' => $complaint_id])
                ->update([
                    'status'                => $input['status'],
                    'finish_date'        => $input['finish_date'],
                    'finish_note'        => $input['finish_note'],
                    'user_update'           => $input['user_update'],
                ]);
            // insert to LacakPengaduan
            $tracking_id = 'TRACK' . date('YmdHis');

            $input_tracking = ([
                'tracking_id'   => $tracking_id,
                'complaint_id'  => $complaint_id,
                'status'        => $input['status'],
            ]);

            LacakPengaduan::create($input_tracking);

            return redirect()->route('pengaduan')->with('success', 'Update Pengaduan berhasil');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function detail($complaint_id)
    {
        $no = 1;
        $decrypt = Crypt::decrypt($complaint_id);
        $data =
            DB::table('lacak_pengaduans')
            ->where('lacak_pengaduans.complaint_id', '=', $decrypt)
            ->get();
        // dd($decrypt);
        return view('pengaduan.detail', [
            'no'    => $no,
            'data'  => $data,
        ]);
    }
}
