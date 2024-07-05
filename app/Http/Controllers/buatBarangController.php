<?php

namespace App\Http\Controllers;

use App\Models\BuatBarang;
use Illuminate\Http\Request;

class buatBarangController extends Controller
{
    public function buatBarang()
    {
        return view('main.buatBarang');
    }

    public function buatBarang_action(Request $request){
        $request->validate([
            'kode_barang' =>'required',
            'nama_barang' => 'required',
            'harga_barang' =>'required',
            'stok_barang' =>'required',
        ]);
        
        $buatBarang = new BuatBarang([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'stok_barang' => $request->stok_barang,
        ]);

        $buatBarang->save();
        return redirect()->route('lihatBarang')->with('success', 'Data berhasil di simpan.');
    }
}
