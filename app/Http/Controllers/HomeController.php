<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BrgKeluar;
use App\Models\BrgMasuk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $kategori = Kategori::count();
        $barang = Barang::count();
        $date = date('Y-m-d');

        $brg_masuk_today = BrgMasuk::where('tgl_brg_masuk', '=', $date)->count();
        $brg_keluar_today = BrgKeluar::where('tgl_brg_keluar', '=', $date)->count();


        return view('home', compact('kategori', 'barang', 'brg_masuk_today', 'brg_keluar_today'));
    }
}
