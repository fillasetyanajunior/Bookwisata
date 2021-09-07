<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PromosiPaketController extends Controller
{
    public function index(Paket $paket)
    {
        $data['cart']         = Cart::content();
        $data['datapaket']    = Paket::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.paket.detailpaket', compact('paket'), $data);
    }
}
