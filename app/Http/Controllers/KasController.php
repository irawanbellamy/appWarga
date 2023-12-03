<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use App\Models\KasKeluar;
use App\Models\KasMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Carbon;

class KasController extends Controller
{
    public function mutasi(Request $request)
    {
        $actionType = $request->input('action_type');
        if($actionType == 'html'){
            $donatur = request()->input('donatur');
            $category = request()->input('category');
            $tipe = request()->input('tipe');
            $no = 1;
            $subquery = DB::table('kas_masuks as km')
                ->select('km.*', 'p.name', 'p.house_block', 'p.house_number')
                ->leftJoin('penghunis as p', 'km.donatur', '=', 'p.id_warga');
            $query = DB::table('kas as k')
                ->select('k.*', 'km.name', 'km.house_block', 'km.house_number', 'km.cash_in_date as tanggal_masuk', 'kk.transaction_date as tanggal_keluar')
                ->leftJoinSub($subquery, 'km', function (JoinClause $join) {
                    $join->on('k.transaction_id', '=', 'km.transaction_id');
                })
                ->leftJoin('kas_keluars as kk', 'k.transaction_id', '=', 'kk.transaction_id')
                ->groupBy('k.transaction_id')
                ->orderByDesc('id');

            if ($donatur) {
                $query->where('km.donatur', '=', $donatur);
            }
            if ($category) {
                $query->where('km.cash_in_category', '=', $category);
            }
            if ($tipe) {
                $query->where('k.cash_type', '=', $tipe);
            }
            $data = $query->get();

            $nama = DB::table('penghunis')->get();

            return view('kas.mutasi', [
                'nama'  => $nama,
                'data'  => $data,
                'no'    => $no,
            ]);
        } elseif($actionType == 'pdf'){
            $donatur = request()->input('donatur');
            $category = request()->input('category');
            $tipe = request()->input('tipe');
            $no = 1;
            $subquery = DB::table('kas_masuks as km')
            ->select('km.*', 'p.name', 'p.house_block', 'p.house_number')
            ->leftJoin('penghunis as p', 'km.donatur', '=', 'p.id_warga');
            $query = DB::table('kas as k')
                ->select('k.*', 'km.name', 'km.house_block', 'km.house_number', 'km.cash_in_date as tanggal_masuk', 'kk.transaction_date as tanggal_keluar')
                ->leftJoinSub($subquery, 'km', function (JoinClause $join) {
                    $join->on('k.transaction_id', '=', 'km.transaction_id');
                })
                ->leftJoin('kas_keluars as kk', 'k.transaction_id', '=', 'kk.transaction_id')
                ->groupBy('k.transaction_id')
                ->orderByDesc('id');

            if ($donatur) {
                $query->where('km.donatur', '=', $donatur);
            }
            if ($category) {
                $query->where('km.cash_in_category', '=', $category);
            }
            if ($tipe) {
                $query->where('k.cash_type', '=', $tipe);
            }
            $data = $query->get();

            $nama = DB::table('penghunis')->get();
            $pdf = Pdf::loadView('kas.mutasiKasPdf', [
                'nama'  => $nama,
                'data'          => $data,
                'no'            => $no,
            ])->setPaper('A4', 'landscape');
            return $pdf->download('mutasi_kas.pdf');
        }

        $donatur = request()->input('donatur');
        $category = request()->input('category');
        $tipe = request()->input('tipe');
        $no = 1;
        $subquery = DB::table('kas_masuks as km')
        ->select('km.*', 'p.name', 'p.house_block', 'p.house_number')
        ->leftJoin('penghunis as p', 'km.donatur', '=', 'p.id_warga');
        $query = DB::table('kas as k')
        ->select('k.*', 'km.name', 'km.house_block', 'km.house_number', 'km.cash_in_date as tanggal_masuk', 'kk.transaction_date as tanggal_keluar')
        ->leftJoinSub($subquery, 'km', function (JoinClause $join) {
            $join->on('k.transaction_id', '=', 'km.transaction_id');
        })
            ->leftJoin('kas_keluars as kk', 'k.transaction_id', '=', 'kk.transaction_id')
            ->groupBy('k.transaction_id')
            ->orderByDesc('id');

        if ($donatur) {
            $query->where('km.donatur', '=', $donatur);
        }
        if ($category) {
            $query->where('km.cash_in_category', '=', $category);
        }
        if ($tipe) {
            $query->where('k.cash_type', '=', $tipe);
        }
        $data = $query->get();

        $nama = DB::table('penghunis')->get();

        return view('kas.mutasi', [
            'nama'  => $nama,
            'data'  => $data,
            'no'    => $no,
        ]);

    }

    public function printMutasiKas()
    {
        $nama = DB::table('penghunis')->get();
        return view('kas.printMutasiKas', [
            'nama'  => $nama,
        ]);
    }

    public function mutasiKasPdf()
    {
        $donatur = request()->input('donatur');
        $category = request()->input('category');
        $tipe = request()->input('tipe');
        $no = 1;
        $subquery = DB::table('kas_masuks as km')
        ->select('km.*', 'p.name', 'p.house_block', 'p.house_number')
        ->leftJoin('penghunis as p', 'km.donatur', '=', 'p.id_warga');
        $query = DB::table('kas as k')
        ->select('k.*', 'km.name', 'km.house_block', 'km.house_number', 'km.cash_in_date as tanggal_masuk', 'kk.transaction_date as tanggal_keluar')
        ->leftJoinSub($subquery, 'km', function (JoinClause $join) {
            $join->on('k.transaction_id', '=', 'km.transaction_id');
        })
            ->leftJoin('kas_keluars as kk', 'k.transaction_id', '=', 'kk.transaction_id')
            ->groupBy('k.transaction_id')
            ->orderByDesc('id');
        if ($donatur) {
            $query->where('km.donatur', '=', $donatur);
        }
        if ($category) {
            $query->where('km.cash_in_category', '=', $category);
        }
        if ($tipe) {
            $query->where('k.cash_type', '=', $tipe);
        }
        $data = $query->get();
        $nama = DB::table('penghunis')->get();
        $pdf = Pdf::loadView('kas.mutasiKasPdf', [
            'nama'  => $nama,
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->download('mutasi_kas.pdf');
    }

    public function rekeningKoran()
    {
        $no = 1;
        $subquery = DB::table('kas_masuks as km')
        ->select('km.*', 'p.name', 'p.house_block', 'p.house_number')
        ->leftJoin('penghunis as p', 'km.donatur', '=', 'p.id_warga');
        $data = DB::table('kas as k')
        ->select('k.*', 'km.name', 'km.house_block', 'km.house_number', 'km.cash_in_date as tanggal_masuk', 'kk.transaction_date as tanggal_keluar')
        ->leftJoinSub($subquery, 'km', function (JoinClause $join) {
            $join->on('k.transaction_id', '=', 'km.transaction_id');
        })
            ->leftJoin('kas_keluars as kk', 'k.transaction_id', '=', 'kk.transaction_id')
            ->groupBy('k.transaction_id')
            ->orderBy('k.id')->get();

        $saldoIn = DB::table('kas_masuks')->sum('amount');
        $saldoOut = DB::table('kas_keluars')->sum('amount');

        // dd($data);

        $pdf = Pdf::loadView('kas.rekeningKoran', [
            'data'          => $data,
            'no'            => $no,
            'saldoIn'         => $saldoIn,
            'saldoOut'         => $saldoOut,
        ])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function listKasMasuk()
    {
        $bulan = request()->input('bulan');
        $tahun = request()->input('tahun');
        $donatur = request()->input('donatur');
        $category = request()->input('category');
        $from = request()->input('from');
        $to = request()->input('to');

        $no = 1;
        $nama = DB::table('penghunis')->get();
        $query = DB::table('kas_masuks as km')
        ->select('km.*', 'p.name', 'p.house_block', 'p.house_number')
        ->leftJoin('penghunis as p', 'km.donatur', '=', 'p.id_warga')
        ->orderByDesc('created_at');

        if ($donatur) {
            $query->where('donatur', '=', $donatur);
        }
        if ($category) {
            $query->where('cash_in_category', '=', $category);
        }
        if ($bulan) {
            $query->where('cash_in_month', '=', $bulan);
        }
        if ($tahun) {
            $query->where('cash_in_year', '=', $tahun);
        }
        if ($from || $to) {
            $query->whereBetween('cash_in_date', [$from, $to]);
        }
        $data = $query->get();
        return view('kas.listKasMasuk', [
            'no' => $no,
            'nama'  => $nama,
            'data' => $data
        ]);
    }

    public function printKasMasuk()
    {
        $nama = DB::table('penghunis')->get();
        return view('kas.printKasMasuk', [
            'nama'  => $nama,
        ]);
    }

    public function mutasiKasMasukPdf()
    {
        $bulan = request()->input('bulan');
        $tahun = request()->input('tahun');
        $donatur = request()->input('donatur');
        $category = request()->input('category');
        $from = request()->input('from');
        $to = request()->input('to');
        $no = 1;
        $nama = DB::table('penghunis')->get();

        $query = DB::table('kas_masuks as km')
        ->select('km.*', 'p.name', 'p.house_block', 'p.house_number')
        ->leftJoin('penghunis as p', 'km.donatur', '=', 'p.id_warga')
        ->orderByDesc('created_at');
        if ($donatur) {
            $query->where('donatur', '=', $donatur);
        }
        if ($category) {
            $query->where('cash_in_category', '=', $category);
        }
        if ($bulan) {
            $query->where('cash_in_month', '=', $bulan);
        }
        if ($tahun) {
            $query->where('cash_in_year', '=', $tahun);
        }
        if ($from || $to) {
            $query->where('cash_in_date', [$from, $to]);
        }
        $data = $query->get();
        $total = $data->sum('amount');
        $pdf = Pdf::loadView('kas.mutasiKasMasukPdf', [
            'nama'        => $nama,
            'total'        => $total,
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->download('kas_masuk.pdf');
    }

    public function rkKasMasuk()
    {
        $no = 1;
        $total = DB::table('kas_masuks')->sum('amount');
        $data = DB::table('kas_masuks as km')
        ->select('km.*', 'p.name', 'p.house_block', 'p.house_number')
        ->leftJoin('penghunis as p', 'km.donatur', '=', 'p.id_warga')
        ->orderByDesc('created_at')->get();
        $pdf = Pdf::loadView('kas.rkKasMasuk', [
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
            'subtransaction_id'         => 'unique:kas_masuks',
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
                    'cash_in_date'              => date(now()),
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


    public function listKasKeluar()
    {
        $category = request()->input('category');
        $from = request()->input('from');
        $to = request()->input('to');

        $no = 1;
        $query = DB::table('kas_keluars')->orderByDesc('created_at');

        if ($category) {
            $query->where('cash_out_category', '=', $category);
        }
        if ($from || $to) {
            $query->whereBetween('transaction_date', [$from, $to]);
        }
        $data = $query->get();
        return view('kas.listKasKeluar', [
            'no'    => $no,
            'data'  => $data,
        ]);
    }

    public function printKasKeluar()
    {
        return view('kas.printKasKeluar');
    }

    public function mutasiKasKeluarPdf()
    {
        $category = request()->input('category');
        $from = request()->input('from');
        $to = request()->input('to');
        $no = 1;
        $query = DB::table('kas_keluars')->orderByDesc('created_at');
        if ($category) {
            $query->where('cash_out_category', '=', $category);
        }
        if ($from || $to) {
            $query->where('transaction_date', [$from, $to]);
        }
        $data = $query->get();
        $total = $data->sum('amount');
        $pdf = Pdf::loadView('kas.mutasiKasKeluarPdf', [
            'total'        => $total,
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->download('kas_keluar.pdf');
    }

    public function rkKasKeluar()
    {
        $no = 1;
        $total = DB::table('kas_keluars')->sum('amount');
        $data = DB::table('kas_keluars')->get();
        $pdf = Pdf::loadView('kas.rkKasKeluar', [
            'total'        => $total,
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function kasKeluar()
    {
        return view('kas.kasKeluar');
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
