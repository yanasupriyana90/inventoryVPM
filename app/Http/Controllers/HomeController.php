<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BrgKeluar;
use App\Models\BrgMasuk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $user = User::count();
        $kategori = Kategori::count();
        $barang = Barang::count();
        $date = date('Y-m-d');

        $brg_masuk_today = BrgMasuk::where('tgl_brg_masuk', '=', $date)->count();
        $brg_keluar_today = BrgKeluar::where('tgl_brg_keluar', '=', $date)->count();

        $stokBarang = Barang::whereRaw('stok <= minStok')->get();

        return view('home', compact('user', 'kategori', 'barang', 'brg_masuk_today', 'brg_keluar_today', 'stokBarang'));
    }
}
