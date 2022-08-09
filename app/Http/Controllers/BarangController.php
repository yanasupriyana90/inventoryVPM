<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

date_default_timezone_set('Asia/Jakarta');

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::join('kategori', 'kategori.id', '=', 'barang.id_kategori')
            ->select('barang.*', 'kategori.nama_kategori')
            ->get();

        $kategori = Kategori::all();

        foreach ($barang as $key) {
            $key->qrCode = QrCode::size(200)->generate($key->id . ' ' . $key->id_kategori);
        }
        // dd($barang);
        return view('admin.master.barang.barang', compact('barang', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Barang::create([
            'id_kategori' => $request->id_kategori,
            'nama_brg' => $request->nama_brg,
            'harga' => $request->harga,
            'minStok' => $request->minStok,
            'stok' => $request->stok,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/barang')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        $barang->id_kategori = $request->id_kategori;
        $barang->nama_brg = $request->nama_brg;
        $barang->harga = $request->harga;
        $barang->minStok = $request->minStok;
        $barang->stok = $request->stok;
        $barang->updated_at = date('Y-m-d H:i:s');

        $barang->save();

        return redirect('/barang')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);

        $barang->delete();

        return redirect('/barang')->with('success', 'Data Berhasil Dihapus');
    }
}
