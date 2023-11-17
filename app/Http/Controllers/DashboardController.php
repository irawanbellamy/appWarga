<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        return view('pages.index');
    }

    public function authenticate(Request $request)
    {
        $akun = $request->validate([
            'email'     => ['required', 'email:dns'],
            'password'  => ['required'],
        ]);


        if (Auth::attempt($akun)) {
            $request->session()->regenerate();
            if (auth()->user()->role == 'ADMIN') {
                return redirect()->intended('dashboard');
            } elseif (auth()->user()->role == 'WARGA') {
                return redirect()->intended('dashboardUser');
            }
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        $asset = DB::table('assets')->count();
        $warga = DB::table('penghunis')->count();
        $pengaduan = DB::table('pengaduans')->count();
        $user = DB::table('users')->count();
        $kas_masuk = DB::table('kas_masuks')->sum('amount');
        $kas_keluar = DB::table('kas_keluars')->sum('amount');
        $saldo = DB::table('kas')->select('last_saldo')->orderByDesc('id')->first();
        return view('pages.dashboard', [
            'asset' => $asset,
            'warga' => $warga,
            'pengaduan' => $pengaduan,
            'user'  => $user,
            'kas_masuk' => $kas_masuk,
            'kas_keluar' => $kas_keluar,
            'saldo' => $saldo,
        ]);
    }

    public function dashboardUser()
    {
        $asset = DB::table('assets')->count();
        $warga = DB::table('penghunis')->count();
        $pengaduan = DB::table('pengaduans')->count();
        $user = DB::table('users')->count();
        $kas_masuk = DB::table('kas_masuks')->sum('amount');
        $kas_keluar = DB::table('kas_keluars')->sum('amount');
        $saldo = DB::table('kas')->select('last_saldo')->orderByDesc('id')->first();
        return view('pages.dashboardUser', [
            'asset' => $asset,
            'warga' => $warga,
            'pengaduan' => $pengaduan,
            'user'  => $user,
            'kas_masuk' => $kas_masuk,
            'kas_keluar' => $kas_keluar,
            'saldo' => $saldo,
        ]);
    }
}
