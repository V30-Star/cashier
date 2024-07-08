<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;

class HistoryController extends Controller
{
    public function index()
    {
        $checkouts = Checkout::all();
        return view('history.index', compact('checkouts'));
    }

    public function show($id)
    {
        $checkout = Checkout::findOrFail($id);
        $items = json_decode($checkout->items, true);
        return view('history.show', compact('checkout', 'items'));
    }
}
