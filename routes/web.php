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
use App\Http\Controllers\User\MasterController;
use App\Http\Controllers\User\ComplaintController;
use App\Http\Controllers\User\UserKasController;

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
Route::get('/', [DashboardController::class, 'index'])->name('login');
Route::post('/', [DashboardController::class, 'authenticate']);
// Otentifikasi
Route::get('/dashboardUser', [DashboardController::class, 'dashboardUser'])->name('dashboardUser');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::post('/logout', [DashboardController::class, 'logout']);
Route::group(["middleware" => "role:ADMIN"], function(){
// Master User
    Route::resource('/warga', WargaController::class)->middleware('auth');
    Route::get('/profile/{user_id}', [WargaController::class, 'profile'])->name('profile');
    Route::put('/profile/update/{user_id}', [WargaController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/getPenghuni/{id}', [WargaController::class, 'getPenghuni'])->name('getPenghuni');
    // Master Warga
    Route::resource('/penghuni', PenghuniController::class);
    // Master Pengurus
    Route::resource('/pengurus', PengurusController::class);

    // Pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
    Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/edit/{complaint_id}', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/update/{complaint_id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
    Route::get('/pengaduan/detail/{complaint_id}', [PengaduanController::class, 'detail'])->name('pengaduan.detail');

// Master Asset
    Route::get('/asset', [AssetController::class, 'index'])->name('asset');
    Route::get('/asset/create', [AssetController::class, 'create'])->name('asset.create');
    Route::post('/asset/store', [AssetController::class, 'store'])->name('asset.store');
    Route::get('/asset/edit/{asset_id}', [AssetController::class, 'edit'])->name('asset.edit');
    Route::put('/asset/put/{asset_id}', [AssetController::class, 'update'])->name('asset.update');
    // Penggunaan Asset
    Route::get('/penggunaanAsset', [PenggunaanAsset::class, 'index'])->name('penggunaanAsset');
    Route::get('/peminjamanAsset', [PeminjamanController::class, 'index'])->name('peminjamanAsset');
    Route::post('/peminjamanAsset/store', [PeminjamanController::class, 'store'])->name('peminjamanAsset.store');
    Route::get('/pengembalianAsset', [PengembalianController::class, 'index'])->name('pengembalianAsset');
    Route::put('/pengembalianAsset/put', [PengembalianController::class, 'update'])->name('pengembalianAsset.update');

    // Kas
    Route::any('/kas', [KasController::class, 'mutasi'])->name('kas');
    Route::get('/rekeningKoran', [KasController::class, 'rekeningKoran'])->name('rekeningKoran');
    Route::get('/printMutasiKas', [KasController::class, 'printMutasiKas'])->name('printMutasiKas');
    Route::get('/mutasiKasPdf', [KasController::class, 'mutasiKasPdf'])->name('mutasiKasPdf');

    Route::any('/listKasMasuk', [KasController::class, 'listKasMasuk'])->name('listKasMasuk');
    Route::get('/printKasMasuk', [KasController::class, 'printKasMasuk'])->name('printKasMasuk');
    Route::get('/rkKasMasuk', [KasController::class, 'rkKasMasuk'])->name('rkKasMasuk');
    Route::get('/mutasiKasMasukPdf', [KasController::class, 'mutasiKasMasukPdf'])->name('mutasiKasMasukPdf');
    Route::get('/kasMasuk', [KasController::class, 'kasMasuk'])->name('kasMasuk');
    Route::post('/kasMasuk/storeKasMasuk', [KasController::class, 'storeKasMasuk'])->name('storeKasMasuk');

    Route::any('/listKasKeluar', [KasController::class, 'listKasKeluar'])->name('listKasKeluar');
    Route::get('/printKasKeluar', [KasController::class, 'printKasKeluar'])->name('printKasKeluar');
    Route::get('/rkKasKeluar', [KasController::class, 'rkKasKeluar'])->name('rkKasKeluar');
    Route::get('/mutasiKasKeluarPdf', [KasController::class, 'mutasiKasKeluarPdf'])->name('mutasiKasKeluarPdf');
    Route::get('/kasKeluar', [KasController::class, 'kasKeluar'])->name('kasKeluar');
    Route::post('/kasKeluar/storeKasKeluar', [KasController::class, 'storeKasKeluar'])->name('storeKasKeluar');
});

Route::group(["prefix" => "/user", "middleware" => "auth"], function(){
    Route::get('/profile/{user_id}', [MasterController::class, 'profile']);
    Route::put('/profile/update/{user_id}', [MasterController::class, 'updateProfile']);
    Route::get('/penghuni', [MasterController::class, 'penghuni']);
    Route::get('/asset', [MasterController::class, 'asset']);
    Route::get('/pengaduan', [ComplaintController::class, 'index'])->name('UserPengaduan');
    Route::get('/pengaduan/create', [ComplaintController::class, 'create']);
    Route::post('/pengaduan/store', [ComplaintController::class, 'store']);
    Route::get('/pengaduan/detail/{complaint_id}', [ComplaintController::class, 'detail'])->name('UserPengaduanDetail');
    Route::any('/mutasi', [UserKasController::class, 'UserMutasi'])->name('UserMutasi');
    Route::get('/rekeningKoran', [UserKasController::class, 'UserRekeningKoran'])->name('UserRekeningKoran');
    Route::any('/filterMutasi', [UserKasController::class, 'filterMutasi'])->name('filterMutasi');
    Route::get('/filterMutasiPdf', [UserKasController::class, 'filterMutasiPdf'])->name('filterMutasiPdf');
    Route::any('/kasMasuk', [UserKasController::class, 'UserKasMasuk'])->name('UserKasMasuk');
    Route::get('/rkKasMasuk', [UserKasController::class, 'UserRkKasMasuk'])->name('UserRkKasMasuk');
    Route::any('/filterKasMasuk', [UserKasController::class, 'filterKasMasuk'])->name('filterKasMasuk');
    Route::get('/filterKasMasukPdf', [UserKasController::class, 'filterKasMasukPdf'])->name('filterKasMasukPdf');
    Route::any('/kasKeluar', [UserKasController::class, 'UserKasKeluar'])->name('UserKasKeluar');
    Route::get('/rkKasKeluar', [UserKasController::class, 'UserRkKasKeluar'])->name('UserRkKasKeluar');
    Route::any('/filterKasKeluar', [UserKasController::class, 'filterKasKeluar'])->name('filterKasKeluar');
    Route::get('/filterKasKeluarPdf', [UserKasController::class, 'filterKasKeluarPdf'])->name('filterKasKeluarPdf');
    Route::get('/iuranSaya/{id_warga}', [UserKasController::class, 'iuranSaya'])->name('iuranSaya');
});

