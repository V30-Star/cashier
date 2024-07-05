<?php

namespace App\Http\Controllers;

use App\Models\BuatBarang;
use Illuminate\Http\Request;

class LihatBarangController extends Controller
{
    public function home()
    {
        return view('main.home');
    }

    public function lihatBarang()
    {
        $data = BuatBarang::all();
        return view('main.lihatBarang', compact('data'));
    } 

    public function delete($kode_barang)
    {
        $data = BuatBarang::where('kode_barang', $kode_barang)->firstOrFail();
        $data->delete();
        return redirect()->route('lihatBarang')->with('success', 'Barang deleted successfully');
    }

    public function edit($kode_barang)
    {
        $barang = BuatBarang::where('kode_barang', $kode_barang)->firstOrFail();
        return view('main.editBarang', compact('barang'));
    }

    public function update(Request $request, $kode_barang)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'harga_barang' => 'required|numeric',
            'stok_barang' => 'required|numeric|min:0',
        ]);

        // Temukan barang berdasarkan kode_barang
        $barang = BuatBarang::where('kode_barang', $kode_barang)->firstOrFail();

        // Perbarui data barang
        $barang->harga_barang = $validatedData['harga_barang'];
        $barang->stok_barang = $validatedData['stok_barang'];
        $barang->save();

        // Redirect ke halaman lihat barang dengan pesan sukses
        return redirect()->route('lihatBarang')->with('success', 'Barang updated successfully');
    }
}
