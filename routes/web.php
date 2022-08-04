<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BrgKeluarController;
use App\Http\Controllers\BrgMasukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

// Index
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');


// Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');


// Home
Route::get('/home', [HomeController::class, 'home'])->middleware('auth');


Route::group(['middleware' => ['auth', 'level:1']], function () {
    // Data Kategori
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::post('/kategori/{id}/update', [KategoriController::class, 'update']);
    Route::get('/kategori/{id}/destroy', [KategoriController::class, 'destroy']);

    // Data Barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/{id}/update', [BarangController::class, 'update']);
    Route::get('/barang/{id}/destroy', [BarangController::class, 'destroy']);

    // Laporan Barang
    Route::get('/lap_barang', [LaporanController::class, 'lap_barang']);
    Route::get('/lap_barang/cetak_barang', [LaporanController::class, 'cetak_barang']);

    // Laporan Kategori
    Route::get('/lap_kategori', [LaporanController::class, 'lap_kategori']);
    Route::get('/lap_kategori/cetak_kategori', [LaporanController::class, 'cetak_kategori']);
});

Route::group(['middleware' => ['auth', 'level:1,2']], function () {
    // Data Barang Masuk
    Route::get('/brg_masuk', [BrgMasukController::class, 'index']);
    Route::get('/brg_masuk/ajax', [BrgMasukController::class, 'ajax']);
    Route::get('/brg_masuk/create', [BrgMasukController::class, 'create']);
    Route::post('/brg_masuk/store', [BrgMasukController::class, 'store']);


    // Data Barang Keluar
    Route::get('/brg_keluar', [BrgKeluarController::class, 'index']);
    Route::get('/brg_keluar/ajax', [BrgKeluarController::class, 'ajax']);
    Route::get('/brg_keluar/create', [BrgKeluarController::class, 'create']);
    Route::post('/brg_keluar/store', [BrgKeluarController::class, 'store']);
});
Route::group(['middleware' => ['auth', 'level:1,2,3']], function () {
    // Laporan Barang Masuk
    Route::get('/lap_brg_masuk', [LaporanController::class, 'lap_brg_masuk']);
    Route::get('/lap_brg_masuk/cetak_brg_masuk', [LaporanController::class, 'cetak_brg_masuk']);


    // Laporan Barang Keluar
    Route::get('/lap_brg_keluar', [LaporanController::class, 'lap_brg_keluar']);
    Route::get('/lap_brg_keluar/cetak_brg_keluar', [LaporanController::class, 'cetak_brg_keluar']);
});
