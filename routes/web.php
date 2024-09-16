<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\PeminjamanBarangController;
use App\Http\Controllers\PeminjamanRuanganController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SesiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'Dashboard.dashboard')->name('dashboard');

//Dashboard sebelum login
Route::get('member',[DashboardController::class,'member'])->name('member.index');
Route::get('peminjamanRuangan',[DashboardController::class,'ruangan'])->name('peminjamanRuangan.index');
Route::get('peminjamanRuangan/{id}', [DashboardController::class, 'detail'])->name('peminjamanRuangan.detail');
Route::get('peminjamanBarang',[DashboardController::class,'barang'])->name('peminjamanBarang.index');

//Routes Login & Logout Pengguna
Route::get('logins',[AuthController::class,'index'])->name('logins.index');
Route::get('loginsMahasiswa',[DashboardController::class,'showLoginForm'])->name('logins.loginMahasiswa');
Route::post('logins/auth',[AuthController::class,'login'])->name('logins.auth');
Route::get('logout',[AuthController::class,'logout'])->name('logins.logout');

//Routes pengguna 
Route::get('pengguna',[PenggunaController::class,'index'])->name('pengguna.index');
Route::get('pengguna/create',[PenggunaController::class,'create'])->name('pengguna.create');
Route::post('pengguna',[PenggunaController::class,'store'])->name('pengguna.store');
Route::get('pengguna/{id}/edit',[PenggunaController::class,'edit'])->name('pengguna.edit');
Route::put('pengguna/{id}',[PenggunaController::class,'update'])->name('pengguna.update');
Route::delete('pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');


//Routes fasilitas
Route::middleware(['auth.pengguna'])->group(function () {
    Route::get('fasilitas',[FasilitasController::class,'index'])->name('fasilitas.index');
    Route::get('fasilitas/create',[FasilitasController::class,'create'])->name('fasilitas.create');
    Route::post('fasilitas',[FasilitasController::class,'store'])->name('fasilitas.store');
    Route::get('fasilitas/{id}/edit',[FasilitasController::class,'edit'])->name('fasilitas.edit');
    Route::put('fasilitas/{id}',[FasilitasController::class,'update'])->name('fasilitas.update');
    Route::delete('fasilitas/{id}',[FasilitasController::class,'destroy'])->name('fasilitas.destroy');    
});

//Routes sesi
Route::middleware(['auth.pengguna'])->group(function () {
    Route::get('sesi',[SesiController::class,'index'])->name('sesi.index');
    Route::get('sesi/create',[SesiController::class,'create'])->name('sesi.create');
    Route::post('sesi',[SesiController::class,'store'])->name('sesi.store');
    Route::get('sesi/{id}/edit',[SesiController::class,'edit'])->name('sesi.edit');
    Route::put('sesi/{id}',[SesiController::class,'update'])->name('sesi.update');
    Route::delete('sesi/{id}',[SesiController::class,'destroy'])->name('sesi.destroy');    
});

//Routes barang
Route::middleware(['auth.pengguna'])->group(function () {
    Route::get('barang',[BarangController::class,'index'])->name('barang.index');
    Route::get('barang/create',[BarangController::class,'create'])->name('barang.create');
    Route::post('barang',[BarangController::class,'store'])->name('barang.store');
    Route::get('barang/{id}/edit',[BarangController::class,'edit'])->name('barang.edit');
    Route::put('barang/{id}',[BarangController::class,'update'])->name('barang.update');
    Route::delete('barang/{id}',[BarangController::class,'destroy'])->name('barang.destroy');    
});

//Routes ruangan
Route::middleware(['auth.pengguna'])->group(function () {
    Route::get('ruangan',[RuanganController::class,'index'])->name('ruangan.index');
    Route::get('detail_ruangan/{id}', [RuanganController::class, 'detail'])->name('ruangan.detail');
    Route::get('ruangan/create',[RuanganController::class,'create'])->name('ruangan.create');
    Route::post('ruangan',[RuanganController::class,'store'])->name('ruangan.store');
    Route::get('ruangan/{id}/edit',[RuanganController::class,'edit'])->name('ruangan.edit');
    Route::put('ruangan/{id}',[RuanganController::class,'update'])->name('ruangan.update');
    Route::delete('ruangan/{id}',[RuanganController::class,'destroy'])->name('ruangan.destroy');    
});

//Routes ruangan
Route::middleware(['auth.pengguna'])->group(function () {
    Route::get('beranda',[DashboardController::class,'beranda'])->name('Dashboard.beranda');  
});

//Dashboard Mahasiswa Setelah Login
Route::get('dashboardMhs',[DashboardMahasiswaController::class,'indexMahasiswa'])->name('dashboard.indexMahasiswa');
Route::get('memberMhs',[DashboardMahasiswaController::class,'member'])->name('member.mahasiswa');
Route::get('peminjamanBarangMhs',[DashboardMahasiswaController::class,'barang'])->name('peminjamanBarang.mahasiswa');
Route::get('peminjamanRuanganMhs',[DashboardMahasiswaController::class,'ruangan'])->name('peminjamanRuangan.mahasiswa');
Route::get('peminjamanRuanganMhs/{id}', [DashboardMahasiswaController::class, 'detail'])->name('peminjamanRuanganDetail.mahasiswa');

//Routes peminjaman ruangan mahasiswa
Route::get('pesanan_ruangan/{id}', [PeminjamanRuanganController::class, 'detail'])->name('pesanan_ruangan.mahasiswa');
Route::post('simpan_ruangan', [PeminjamanRuanganController::class, 'store'])->name('simpan_ruangan.mahasiswa');
Route::get('riwayat_peminjaman_ruangan', [PeminjamanRuanganController::class, 'index'])->name('riwayat_peminjaman_ruangan.mahasiswa');
Route::get('pesanan_ruangan/{id}/editRuanganSebelum', [PeminjamanRuanganController::class, 'editRuanganSebelum'])->name('pesanan_ruangan.editRuanganSebelum');
Route::put('pesanan_ruangan/{id}/updateRuanganSebelum', [PeminjamanRuanganController::class, 'updateRuanganSebelum'])->name('pesanan_ruangan.updateRuanganSebelum');
Route::get('pesanan_ruangan/{id}/editRuanganSesudah', [PeminjamanRuanganController::class, 'editRuanganSesudah'])->name('pesanan_ruangan.editRuanganSesudah');
Route::put('pesanan_ruangan/{id}/updateRuanganSesudah', [PeminjamanRuanganController::class, 'updateRuanganSesudah'])->name('pesanan_ruangan.updateRuanganSesudah');
Route::get('pesanan_ruangan_detail/{id}', [PeminjamanRuanganController::class, 'formDetail'])->name('pesanan_ruangan.formDetail');
Route::get('/get-sesi-details/{sesi_id}', [PeminjamanRuanganController::class, 'getSesiDetails']);

//Routes riwayat peminjaman ruangan user
Route::get('RiwayatPeminjamanRuangan', [PeminjamanRuanganController::class, 'riwayatPeminjamanRuangan'])->name('riwayatPeminjamanRuangan.mahasiswa');
Route::delete('RiwayatPeminjamanRuangan/{id}/tolak', [PeminjamanRuanganController::class, 'destroy'])->name('tolakRuangan.destroy');
Route::delete('RiwayatPeminjamanRuangan/{id}/acc', [PeminjamanRuanganController::class, 'acc'])->name('accRuangan.acc');
Route::delete('RiwayatPeminjamanRuangan/{id}/Finalacc', [PeminjamanRuanganController::class, 'accFinal'])->name('accFinalRuangan.accFinal');
Route::get('riwayatPeminjamanRuangan_detail/{id}', [PeminjamanRuanganController::class, 'detailRiwayat'])->name('riwayatPeminjamanRuangan.detail');

//Routes peminjaman barang mahasiswa
Route::get('pesanan_barang', [PeminjamanBarangController::class, 'create'])->name('pesanan_barang.mahasiswa');
Route::post('simpan_barang',[PeminjamanBarangController::class,'store'])->name('simpan_barang.mahasiswa');
Route::get('riwayat_peminjaman_barang', [PeminjamanBarangController::class, 'index'])->name('riwayat_peminjaman_barang.mahasiswa');
Route::get('pesanan_barang/{id}/editBarangSebelum', [PeminjamanBarangController::class, 'editBarangSebelum'])->name('pesanan_barang.editBarangSebelum');
Route::put('pesanan_barang/{id}/updateBarangSebelum', [PeminjamanBarangController::class, 'updateBarangSebelum'])->name('pesanan_barang.updateBarangSebelum');
Route::get('pesanan_barang/{id}/editBarangSesudah', [PeminjamanBarangController::class, 'editBarangSesudah'])->name('pesanan_barang.editBarangSesudah');
Route::put('pesanan_barang/{id}/updateBarangSesudah', [PeminjamanBarangController::class, 'updateBarangSesudah'])->name('pesanan_barang.updateBarangSesudah');
Route::get('pesanan_barang_detail/{id}', [PeminjamanBarangController::class, 'formDetail'])->name('pesanan_barang.formDetail');
Route::post('tambahKeranjang/{barang_id}', [PeminjamanBarangController::class, 'addKeranjang'])->name('addKeranjang.mahasiswa');
Route::get('keranjang', [PeminjamanBarangController::class, 'viewKeranjang'])->name('viewKeranjang.mahasiswa');
Route::put('/barang/addQuantity/{id}/{jmlh}', [PeminjamanBarangController::class, 'addQuantity']);
Route::put('/barang/subtractQuantity/{id}/{jmlh}', [PeminjamanBarangController::class, 'subtractQuantity']);
Route::delete('/barang/deleteItem/{id}', [PeminjamanBarangController::class, 'deleteItem']);
Route::get('/get-sesi-details/{sesi_id}', [PeminjamanBarangController::class, 'getSesiDetails']);

//Routes riwayat peminjaman barang user
Route::get('RiwayatPeminjamanBarang', [PeminjamanBarangController::class, 'riwayatPeminjamanBarang'])->name('riwayatPeminjamanBarang.mahasiswa');
Route::get('riwayatPeminjamanBarang_detail/{id}', [PeminjamanBarangController::class, 'detailRiwayat'])->name('riwayatPeminjamanBarang.detail');
Route::delete('RiwayatPeminjamanBarang/{id}/tolak', [PeminjamanBarangController::class, 'destroy'])->name('tolakBarang.destroy');
Route::delete('RiwayatPeminjamanBarang/{id}/acc', [PeminjamanBarangController::class, 'acc'])->name('accBarang.acc');
Route::delete('RiwayatPeminjamanBarang/{id}/Finalacc', [PeminjamanBarangController::class, 'accFinal'])->name('accFinalBarang.accFinal');