<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BrgKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Asia/Jakarta');

class BrgKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brg_keluar = BrgKeluar::join('barang', 'barang.id', '=', 'brg_keluar.id_brg')
            ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
            ->select('brg_keluar.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_brg')
            ->get();

        $barang = Barang::all();

        return view('admin.transaksi.brg_keluar.brg_keluar', compact('brg_keluar', 'brg_keluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();

        $q = DB::table('brg_keluar')->select(DB::raw('MAX(RIGHT(no_brg_keluar,4)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        return view('admin.transaksi.brg_keluar.add', compact('barang', 'kd'));
    }

    public function ajax(Request $request)
    {
        $id_brg['id_brg'] = $request->id_brg;
        $ajax_barang = Barang::where('id', $id_brg)->first();

        echo json_encode($ajax_barang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $barang = Barang::find($request->id_brg);

        if ($barang->stok < $request->jml_brg_keluar) {
            return redirect('/brg_keluar/create')->with('error', 'Jumlah Barang Melebihi Stok');
        } else {
            BrgKeluar::create([
                'no_brg_keluar'  => $request->no_brg_keluar,
                'id_brg'         => $request->id_brg,
                'id_user'        => $request->id_user,
                'tgl_brg_keluar' => $request->tgl_brg_keluar,
                'jml_brg_keluar' => $request->jml_brg_keluar,
                'total'          => $request->total,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ]);

            $barang->stok -= $request->jml_brg_keluar;
            $barang->save();

            return redirect('/brg_keluar')->with('success', 'Data Berhasil Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrgKeluar  $brgKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(BrgKeluar $brgKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrgKeluar  $brgKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(BrgKeluar $brgKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrgKeluar  $brgKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrgKeluar $brgKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrgKeluar  $brgKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrgKeluar $brgKeluar)
    {
        //
    }
}
