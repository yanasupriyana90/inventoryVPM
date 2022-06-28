<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BrgMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Asia/Jakarta');

class BrgMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brg_masuk = BrgMasuk::join('barang', 'barang.id', '=', 'brg_masuk.id_brg')
                    ->join('kategori', 'kategori.id', '=', 'barang.id_kategori')
                    ->select('brg_masuk.*', 'kategori.nama_kategori', 'barang.harga', 'barang.nama_brg')
                    ->get();

        $barang = Barang::all();

        return view('admin.transaksi.brg_masuk.brg_masuk', compact('brg_masuk', 'brg_masuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();

        $q = DB::table('brg_masuk')->select(DB::raw('MAX(RIGHT(no_brg_masuk,4)) as kode'));
        $kd="";
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = "0001";
        }


        return view('admin.transaksi.brg_masuk.add', compact('barang', 'kd'));
    }

    public function ajax(Request $request)
    {
        $id_brg['id_brg'] = $request->id_brg;
        $ajax_barang = Barang::where('id', $id_brg)->get();

        return view('admin.transaksi.brg_masuk.ajax', compact('ajax_barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        BrgMasuk::create([
            'no_brg_masuk' => $request->no_brg_masuk,
            'id_brg' => $request->id_brg,
            'id_user' => $request->id_user,
            'tgl_brg_masuk' => $request->tgl_brg_masuk,
            'jml_brg_masuk' => $request->jml_brg_masuk,
            'total' => $request->total,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $barang = Barang::find($request->id_brg);

        $barang->stok += $request->jml_brg_masuk;
        $barang->save();


        return redirect('/brg_masuk')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrgMasuk  $brgMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BrgMasuk $brgMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrgMasuk  $brgMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(BrgMasuk $brgMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrgMasuk  $brgMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrgMasuk $brgMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrgMasuk  $brgMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrgMasuk $brgMasuk)
    {
        //
    }
}
