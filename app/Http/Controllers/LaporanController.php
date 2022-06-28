<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BrgKeluar;
use App\Models\BrgMasuk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Laporan Kategori
    public function lap_kategori()
    {
        $kategori = Kategori::all();

        return view('admin.laporan.kategori.lap_kategori', compact('kategori'));
    }

    public function cetak_kategori()
    {
        $kategori = Kategori::all();

        return view('admin.laporan.kategori.cetak_kategori', compact('kategori'));
    }
    // End Laporan Kategori


    // Laporan Barang
    public function lap_barang()
    {
        $barang = Barang::join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                  ->select('barang.*', 'kategori.nama_kategori')
                  ->get();

        return view('admin.laporan.barang.lap_barang', compact('barang'));
    }

    public function cetak_barang()
    {
        $barang = Barang::join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                  ->select('barang.*', 'kategori.nama_kategori')
                  ->get();

        return view('admin.laporan.barang.cetak_barang', compact('barang'));
    }
    // End Laporan Barang


    // Laporan Barang Masuk
    public function lap_brg_masuk()
    {
        $brg_masuk = BrgMasuk::join('barang', 'barang.id', '=', 'brg_masuk.id_brg')
                    ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                    ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_brg')
                    ->get();

        return view('admin.laporan.brg_masuk.lap_brg_masuk', compact('brg_masuk'));
    }

    public function cetak_brg_masuk(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        if($tgl_mulai AND $tgl_selesai) {
            $brg_masuk = BrgMasuk::join('barang', 'barang.id', '=', 'brg_masuk.id_brg')
                        ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_brg')
                        ->whereBetween('brg_masuk.tgl_brg_masuk', [$tgl_mulai, $tgl_selesai])
                        ->get();

            $sum_total = BrgMasuk::whereBetween('tgl_brg_masuk', [$tgl_mulai, $tgl_selesai])
                        ->sum('total');



        }else{
            $brg_masuk = BrgMasuk::join('barang', 'barang.id', '=', 'brg_masuk.id_brg')
                        ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_brg')
                        ->get();
        }


        return view('admin.laporan.brg_masuk.cetak_brg_masuk', compact('brg_masuk', 'sum_total', 'tgl_mulai', 'tgl_selesai'));
    }
    // End Laporan Barang Masuk


    // Laporan Barang Keluar
    public function lap_brg_keluar()
    {
        $brg_keluar = BrgKeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_brg')
                    ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                    ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_brg')
                    ->get();

        return view('admin.laporan.brg_keluar.lap_brg_keluar', compact('brg_keluar'));
    }

    public function cetak_brg_keluar(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        if($tgl_mulai AND $tgl_selesai) {
            $brg_keluar = BrgKeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_brg')
                        ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_brg')
                        ->whereBetween('brg_keluar.tgl_brg_keluar', [$tgl_mulai, $tgl_selesai])
                        ->get();

            $sum_total = BrgKeluar::whereBetween('tgl_brg_keluar', [$tgl_mulai, $tgl_selesai])
                        ->sum('total');



        }else{
            $brg_keluar = BrgKeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_brg')
                        ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                        ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_brg')
                        ->get();
        }


        return view('admin.laporan.brg_keluar.cetak_brg_keluar', compact('brg_keluar', 'sum_total', 'tgl_mulai', 'tgl_selesai'));
    }
    // End Laporan Barang Keluar
}
