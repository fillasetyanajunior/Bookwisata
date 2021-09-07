<?php

namespace App\Http\Controllers;

use App\Models\Kuliner;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PromosiKulinerController extends Controller
{
    public function index(Kuliner $kuliner)
    {
        $data['cart']           = Cart::content();
        $data['datakuliner']    = Kuliner::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.kuliner.detailkuliner', compact('kuliner'), $data);
    }
}
