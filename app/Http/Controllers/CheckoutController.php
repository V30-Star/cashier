<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        $keranjang = session()->get('keranjang', []);

        // Validasi jika keranjang kosong
        if (empty($keranjang)) {
            return redirect()->route('keranjang')->with('error', 'Keranjang kosong. Tidak ada barang untuk di-checkout.');
        }

        $checkout = new Checkout();
        $checkout->buyer_name = $request->input('buyerName');
        $checkout->purchase_date = $request->input('purchaseDate');
        $checkout->items = json_encode($keranjang); // Simpan keranjang sebagai JSON
        $checkout->save();

        // Hapus keranjang dari sesi setelah berhasil checkout
        session()->forget('keranjang');

        return redirect()->route('history')->with('success', 'Checkout berhasil');
    }

    public function delete($id)
    {
        $checkout = Checkout::findOrFail($id);
        $checkout->delete();

        return redirect()->route('history')->with('success', 'Data checkout berhasil dihapus');
    }
}
