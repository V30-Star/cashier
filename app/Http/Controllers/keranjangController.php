<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuatBarang;

class keranjangController extends Controller
{
    public function keranjang(Request $request)
    {
        $keranjang = session()->get('keranjang', []);
        return view('main/keranjang', compact('keranjang'));
    }

    public function addToKeranjang(Request $request)
    {
        $keranjang = session()->get('keranjang', []);

        $total_harga = $request->harga_barang * $request->jumlah_barang;

        $keranjang[] = array_merge($request->all(), ['total_harga' => $total_harga]);
        session()->put('keranjang', $keranjang);

        return response()->json(['success' => true]);
    }
    public function removeFromKeranjang($kode_barang)
    {
        $keranjang = session()->get('keranjang', []);
        foreach ($keranjang as $index => $item) {
            if ($item['kode_barang'] == $kode_barang) {
                unset($keranjang[$index]);
                break;
            }
        }

        $keranjang = array_values($keranjang);        

        session()->put('keranjang', $keranjang); // Re-index array
        return redirect()->route('keranjang')->with('success', 'Barang dihapus dari keranjang');
    }

    public function checkout(Request $request)
    {
        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('keranjang')->with('error', 'Keranjang kosong. Tidak ada barang untuk di-checkout.');
        }

        foreach ($keranjang as $item) {
            $barang = BuatBarang::where('kode_barang', $item['kode_barang'])->first();

            if ($barang) {
                if ($barang->stok_barang >= $item['jumlah_barang']) {
                    $barang->stok_barang -= $item['jumlah_barang'];
                    $barang->save();
                } else {
                    return redirect()->route('keranjang')->with('error', 'Stok barang tidak mencukupi.');
                }
            }
        }

        // Clear the cart after successful checkout
        session()->forget('keranjang');

        return redirect()->route('keranjang')->with('success', 'Checkout berhasil. Stok barang diperbarui.');
    }

    public function edit($kode_barang)
{
    // Dapatkan keranjang dari sesi
    $keranjang = session()->get('keranjang', []);

    // Temukan barang berdasarkan kode_barang di dalam keranjang
    $barang = null;
    foreach ($keranjang as $item) {
        if ($item['kode_barang'] == $kode_barang) {
            $barang = $item;
            break;
        }
    }

    if ($barang === null) {
        return redirect()->route('keranjang')->with('error', 'Barang tidak ditemukan dalam keranjang.');
    }

    return view('main.editKeranjang', compact('barang'));
}


public function update(Request $request, $kode_barang)
{
    // Validasi data yang masuk
    $validatedData = $request->validate([
        'harga_barang' => 'required|numeric',
        'jumlah_barang' => 'required|numeric|min:1',
    ]);

    // Dapatkan keranjang dari sesi
    $keranjang = session()->get('keranjang', []);

    // Temukan barang berdasarkan kode_barang di dalam keranjang
    foreach ($keranjang as $index => $item) {
        if ($item['kode_barang'] == $kode_barang) {
            // Perbarui data barang
            $keranjang[$index]['harga_barang'] = $validatedData['harga_barang'];
            $keranjang[$index]['jumlah_barang'] = $validatedData['jumlah_barang'];
            $keranjang[$index]['total_harga'] = $validatedData['harga_barang'] * $validatedData['jumlah_barang'];
            break;
        }
    }

    // Simpan perubahan ke sesi
    session()->put('keranjang', $keranjang);

    // Redirect ke halaman keranjang dengan pesan sukses
    return redirect()->route('keranjang')->with('success', 'Barang dalam keranjang berhasil diperbarui');
}
}
