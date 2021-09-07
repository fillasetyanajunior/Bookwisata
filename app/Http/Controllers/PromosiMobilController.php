<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PromosiMobilController extends Controller
{
    public function index(Mobil $mobil)
    {
        $data['cart']         = Cart::content();
        $data['datamobil']    = Mobil::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.mobil.detailmobil', compact('mobil'), $data);
    }
}
