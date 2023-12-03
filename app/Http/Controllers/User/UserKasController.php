<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;

class UserKasController extends Controller
{
    public function UserMutasi(Request $request){
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

            return view('UserKas.mutasi', [
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
            $pdf = Pdf::loadView('UserKas.filterMutasiPdf', [
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

        return view('UserKas.mutasi', [
            'nama'  => $nama,
            'data'  => $data,
            'no'    => $no,
        ]);
    }

    public function UserRekeningKoran(){
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
            ->orderBy('k.id')
            ->get();

        $saldoIn = DB::table('kas_masuks')->sum('amount');
        $saldoOut = DB::table('kas_keluars')->sum('amount');

        $pdf = Pdf::loadView('UserKas.rekeningKoran', [
            'data'          => $data,
            'no'            => $no,
            'saldoIn'         => $saldoIn,
            'saldoOut'         => $saldoOut,
        ])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function filterMutasi(){
        $nama = DB::table('penghunis')->get();
        return view('UserKas.filterMutasi', [
            'nama'  => $nama,
        ]);
    }

    public function filterMutasiPdf(){
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
        $pdf = Pdf::loadView('UserKas.filterMutasiPdf', [
            'nama'  => $nama,
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->download('mutasi_kas.pdf');
    }

    public function UserKasMasuk(Request $request){

        $actionType = $request->input('action_type');
        if($actionType == 'html'){
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
                ->orderByDesc('id');

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
            return view('UserKas.kasMasuk', [
                'no' => $no,
                'nama'  => $nama,
                'data' => $data
            ]);
        } elseif($actionType == 'pdf'){
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
            $pdf = Pdf::loadView('UserKas.filterKasMasukPdf', [
                    'nama'        => $nama,
                    'total'        => $total,
                    'data'          => $data,
                    'no'            => $no,
                ])->setPaper('A4', 'landscape');
            return $pdf->download('kas_masuk.pdf');
        }

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
        ->orderByDesc('id');

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
        return view('UserKas.kasMasuk', [
            'no' => $no,
            'nama'  => $nama,
            'data' => $data
        ]);

    }

    public function UserRkKasMasuk(){
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

    public function filterKasMasuk(){
        $nama = DB::table('penghunis')->get();
        return view('UserKas.filterKasMasuk', [
            'nama'  => $nama,
        ]);
    }

    public function filterKasMasukPdf(){
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
        $pdf = Pdf::loadView('UserKas.filterKasMasukPdf', [
            'nama'        => $nama,
            'total'        => $total,
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->download('kas_masuk.pdf');
    }

    public function UserKasKeluar(Request $request){

        $actionType = $request->input('action_type');

        if($actionType == 'html'){
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
            return view('UserKas.kasKeluar', [
                'no'    => $no,
                'data'  => $data,
            ]);
        } elseif($actionType == 'pdf') {
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
            $pdf = Pdf::loadView('UserKas.filterKasKeluarPdf', [
                    'total'        => $total,
                    'data'          => $data,
                    'no'            => $no,
                ])->setPaper('A4', 'landscape');
            return $pdf->download('kas_keluar.pdf');
        }

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
        return view('UserKas.kasKeluar', [
            'no'    => $no,
            'data'  => $data,
        ]);
    }

    public function UserRkKasKeluar(){
        $no = 1;
        $total = DB::table('kas_keluars')->sum('amount');
        $data = DB::table('kas_keluars')->get();
        $pdf = Pdf::loadView('UserKas.rkKasKeluar', [
            'total'        => $total,
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function filterKasKeluar(){
        return view('UserKas.filterKasKeluar');
    }

    public function filterKasKeluarPdf(){
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
        $pdf = Pdf::loadView('UserKas.filterKasKeluarPdf', [
            'total'        => $total,
            'data'          => $data,
            'no'            => $no,
        ])->setPaper('A4', 'landscape');
        return $pdf->download('kas_keluar.pdf');
    }

    public function iuranSaya($id_warga){
        $decrypt = Crypt::decrypt($id_warga);
        $data = DB::select('select * from kas_masuks where donatur = ?', [$decrypt]);
        // dd($data);
        return view('UserKas.iuranSaya', [
            'data'  => $data,
        ]);
    }
}
