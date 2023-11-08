<?php

use App\Http\Controllers\AssetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenggunaanAsset;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\WargaController;
use App\Models\PeminjamanAsset;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Otentifikasi
Route::get('/', [DashboardController::class, 'index'])->name('login');
Route::post('/', [DashboardController::class, 'authenticate']);
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/dashboardUser', [DashboardController::class, 'dashboardUser'])->name('dashboardUser')->middleware('auth');
Route::post('/logout', [DashboardController::class, 'logout']);

// Master User
Route::resource('/warga', WargaController::class)->middleware('auth');
// Master Warga
Route::resource('/penghuni', PenghuniController::class)->middleware('auth');
// Master Pengurus
Route::resource('/pengurus', PengurusController::class)->middleware('auth');

// Pengaduan
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan')->middleware('auth');
Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create')->middleware('auth');
Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store')->middleware('auth');
Route::get('/pengaduan/edit/{complaint_id}', [PengaduanController::class, 'edit'])->name('pengaduan.edit')->middleware('auth');
Route::put('/pengaduan/update/{complaint_id}', [PengaduanController::class, 'update'])->name('pengaduan.update')->middleware('auth');
Route::get('/pengaduan/detail/{complaint_id}', [PengaduanController::class, 'detail'])->name('pengaduan.detail')->middleware('auth');

// Master Asset
Route::get('/asset', [AssetController::class, 'index'])->name('asset')->middleware('auth');
Route::get('/asset/create', [AssetController::class, 'create'])->name('asset.create')->middleware('auth');
Route::post('/asset/store', [AssetController::class, 'store'])->name('asset.store')->middleware('auth');
Route::get('/asset/edit/{asset_id}', [AssetController::class, 'edit'])->name('asset.edit')->middleware('auth');
Route::put('/asset/put/{asset_id}', [AssetController::class, 'update'])->name('asset.update')->middleware('auth');
// Penggunaan Asset
Route::get('/penggunaanAsset', [PenggunaanAsset::class, 'index'])->name('penggunaanAsset')->middleware('auth');
Route::get('/peminjamanAsset', [PeminjamanController::class, 'index'])->name('peminjamanAsset')->middleware('auth');
Route::post('/peminjamanAsset/store', [PeminjamanController::class, 'store'])->name('peminjamanAsset.store')->middleware('auth');
Route::get('/pengembalianAsset', [PengembalianController::class, 'index'])->name('pengembalianAsset')->middleware('auth');
Route::put('/pengembalianAsset/put', [PengembalianController::class, 'update'])->name('pengembalianAsset.update')->middleware('auth');

// Kas
Route::get('/kas', [KasController::class, 'mutasi'])->name('kas')->middleware('auth');
Route::get('/printMutasiKas', [KasController::class, 'printMutasiKas'])->name('printMutasiKas')->middleware('auth');
Route::get('/listKasMasuk', [KasController::class, 'listKasMasuk'])->name('listKasMasuk')->middleware('auth');
Route::get('/printKasMasuk', [KasController::class, 'printKasMasuk'])->name('printKasMasuk')->middleware('auth');
Route::get('/kasMasuk', [KasController::class, 'kasMasuk'])->name('kasMasuk')->middleware('auth');
Route::post('/kasMasuk/storeKasMasuk', [KasController::class, 'storeKasMasuk'])->name('storeKasMasuk')->middleware('auth');
Route::get('/listKasKeluar', [KasController::class, 'listKasKeluar'])->name('listKasKeluar')->middleware('auth');
Route::get('/printKasKeluar', [KasController::class, 'printKasKeluar'])->name('printKasKeluar')->middleware('auth');
Route::get('/kasKeluar', [KasController::class, 'kasKeluar'])->name('kasKeluar')->middleware('auth');
Route::post('/kasKeluar/storeKasKeluar', [KasController::class, 'storeKasKeluar'])->name('storeKasKeluar')->middleware('auth');
