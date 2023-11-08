<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use App\Models\KasKeluar;
use App\Models\KasMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;

class KasController extends Controller
{
    public function mutasi()
    {
        $no = 1;
        // $data = DB::table('kas')->orderByDesc('created_at')->get();
        $data = DB::table('kas as k')
        ->select('k.*', 'km.donatur', 'km.created_at as tanggal_masuk', 'kk.created_at as tanggal_keluar')
        ->leftJoin('kas_masuks as km', 'k.transaction_id', '=', 'km.transaction_id')
        ->leftJoin('kas_keluars as kk', 'k.transaction_id', '=', 'kk.transaction_id')
        ->groupBy('k.transaction_id')
        ->get();
            // dd($data);
        return view('kas.mutasi', [
            'data'  => $data,
            'no'    => $no,
        ]);
    }

    public function printMutasiKas(){
        $no = 1;
        $data = DB::table('kas as k')
        ->select('k.*', 'km.donatur', 'km.created_at as tanggal_masuk', 'kk.created_at as tanggal_keluar')
        ->leftJoin('kas_masuks as km', 'k.transaction_id', '=', 'km.transaction_id')
        ->leftJoin('kas_keluars as kk', 'k.transaction_id', '=', 'kk.transaction_id')
        ->groupBy('k.transaction_id')
        ->get();
        $pdf = Pdf::loadView('kas.printMutasiKas', [
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function listKasMasuk(){
        $no = 1;
        $data = DB::table('kas_masuks')->orderByDesc('created_at')->get();
        return view('kas.listKasMasuk', [
            'no' => $no,
            'data' => $data
        ]);
    }

    public function printKasMasuk(){
        $no = 1;
        $total = DB::table('kas_masuks')->sum('amount');
        $data = DB::table('kas_masuks')
            ->get();
        $pdf = Pdf::loadView('kas.printKasMasuk', [
            'total'        => $total,
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function kasMasuk()
    {
        $nama = DB::table('penghunis')->get();
        return view('kas.kasMasuk', [
            'nama'      => $nama,
        ]);
    }

    public function storeKasMasuk(Request $request)
    {
        $request->validate([
            'donatur'                   => 'required',
            'cash_in_category'          => 'required',
            'cash_in_methode'           => 'required',
            'amount'                    => 'required',
            'user_input'                => 'required',
        ]);

        // kas masuk jika berupa iuran

        $bulan = $input['cash_in_month'] =  $request->input('cash_in_month');
        $no = 1;
        if ($bulan != null) {
            foreach ($bulan as $b) {
                $runingNumber = sprintf("%03d", $no++);
                $add = ([
                    'transaction_id'            => 'KIN' . date('YmdHi'),
                    'subtransaction_id'         => 'KIN' . date('YmdHi') . $runingNumber,
                    'cash_in_month'             => $b,
                    'donatur'                   => $request['donatur'],
                    'cash_in_category'          => $request['cash_in_category'],
                    'cash_in_methode'           => $request['cash_in_methode'],
                    'amount'                    => $request['amount'],
                    'cash_in_year'              => $request['cash_in_year'],
                    'cash_in_attachment'        => $request['cash_in_attachment'],
                    'cash_in_note'              => $request['cash_in_note'],
                    'user_input'                => $request['user_input'],
                ]);
                $id = 'KIN' . date('YmdHi');
                if ($request->file('cash_in_attachment') != null) {

                    $image = $request->file('cash_in_attachment');
                    // nama file
                    $add['cash_in_attachment'] = $id . '.' . $image->getClientOriginalExtension();
                    // folder upload image
                    $destinationPath = 'upload';
                    $img = Image::make($image->getRealPath());
                    $img->resize(200, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $add['cash_in_attachment']);
                }
                KasMasuk::create($add);
            }

            $last_saldo = 0;
            $ls = DB::table('kas')->select('last_saldo')->orderByDesc('id')->first();
            if ($ls == null) {
                $last_saldo;
            } else {
                $last_saldo = (float) $ls->last_saldo;
            }
            $count_bulan = count($bulan);
            $cash_in_amount = $count_bulan * $add['amount'];

            $reference = 'MUT' . date('YmdHis');
            $type = 'MASUK';
            $input_mutasi = ([
                'reference_id'      => $reference,
                'transaction_id'    => $add['transaction_id'],
                'cash_type'         => $type,
                'cash_in_category'  => $add['cash_in_category'],
                'cash_in_amount'    => $cash_in_amount,
                'user_input'        => $add['user_input'],
                'last_saldo'        => $last_saldo + $cash_in_amount,
            ]);

            Kas::create($input_mutasi);

            // kas masuk jika berupa donasi
        } else {
            $runingNumber = sprintf("%03d", KasMasuk::count() + 1);
            $input = ([
                'transaction_id'            => 'KIN' . date('YmdHi'),
                'subtransaction_id'         => 'KIN' . date('YmdHi') . $runingNumber,
                'donatur'                   => $request['donatur'],
                'cash_in_category'          => $request['cash_in_category'],
                'cash_in_methode'           => $request['cash_in_methode'],
                'amount'                    => $request['amount'],
                'cash_in_year'              => $request['cash_in_year'],
                'cash_in_attachment'        => $request['cash_in_attachment'],
                'cash_in_note'              => $request['cash_in_note'],
                'user_input'                => $request['user_input'],
            ]);
            if ($request->file('cash_in_attachment') != null) {
                $id = 'KIN' . date('YmdHi');
                $image = $request->file('cash_in_attachment');
                // nama file
                $input['cash_in_attachment'] = $id . '.' . $image->getClientOriginalExtension();
                // folder upload image
                $destinationPath = 'upload';
                $img = Image::make($image->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['cash_in_attachment']);
            }

            KasMasuk::create($input);

            $last_saldo = 0;
            $ls = DB::table('kas')->select('last_saldo')->orderByDesc('id')->first();
            if ($ls == null) {
                $last_saldo;
            } else {
                $last_saldo = (float) $ls->last_saldo;
            }
            $reference = 'MUT' . date('YmdHis');
            $type = 'MASUK';

            $input_mutasi = ([
                'reference_id'      => $reference,
                'transaction_id'    => $input['transaction_id'],
                'cash_type'         => $type,
                'cash_in_category'  => $input['cash_in_category'],
                'cash_in_amount'    => $input['amount'],
                'user_input'        => $input['user_input'],
                'last_saldo'        => $last_saldo + $input['amount'],
            ]);

            Kas::create($input_mutasi);
        }
        return redirect('listKasMasuk')->with('success', 'Input Kas Masuk Berhasil');
    }

    public function kasKeluar()
    {

        return view('kas.kasKeluar');
    }

    public function listKasKeluar(){
        $no = 1;
        $data = DB::table('kas_keluars')->orderByDesc('created_at')->get();
        return view('kas.listKasKeluar', [
            'no'    => $no,
            'data'  => $data,
        ]);
    }

    public function printKasKeluar()
    {
        $no = 1;
        $total = DB::table('kas_keluars')->sum('amount');
        $data = DB::table('kas_keluars')->get();
        $pdf = Pdf::loadView('kas.printKasKeluar', [
            'total'        => $total,
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function storeKasKeluar(Request $request)
    {
        $request->validate([
            'cash_out_category'     => 'required',
            'amount'                => 'required',
            'transaction_date'      => 'required',
            'user_input'            => 'required',
        ]);

        $input = ([
            'transaction_id'            => 'KOUT' . date('YmdHis'),
            'cash_out_category'         => $request['cash_out_category'],
            'amount'                    => $request['amount'],
            'transaction_date'          => $request['transaction_date'],
            'cash_out_attachment'       => $request['cash_out_attachment'],
            'cash_out_note'             => $request['cash_out_note'],
            'user_input'                => $request['user_input'],
        ]);
        if ($request->file('cash_out_attachment') != null) {
            $id = 'KOUT' . date('YmdHis');
            $image = $request->file('cash_out_attachment');
            // nama file
            $input['cash_out_attachment'] = $id . '.' . $image->getClientOriginalExtension();
            // folder upload image
            $destinationPath = 'upload';
            $img = Image::make($image->getRealPath());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['cash_out_attachment']);
        }

        KasKeluar::create($input);

        $last_saldo = 0;
        $ls = DB::table('kas')->select('last_saldo')->orderByDesc('id')->first();
        if ($ls == null) {
            $last_saldo;
        } else {
            $last_saldo = (float) $ls->last_saldo;
        }
        $reference = 'MUT' . date('YmdHis');
        $type = 'KELUAR';

        $input_mutasi = ([
            'reference_id'      => $reference,
            'transaction_id'    => $input['transaction_id'],
            'cash_type'         => $type,
            'cash_out_category' => $input['cash_out_category'],
            'cash_out_amount'   => $input['amount'],
            'user_input'        => $input['user_input'],
            'last_saldo'        => $last_saldo - $input['amount'],
        ]);

        Kas::create($input_mutasi);

        return redirect('kas')->with('success', 'Input Kas Masuk Berhasil');
    }
}
