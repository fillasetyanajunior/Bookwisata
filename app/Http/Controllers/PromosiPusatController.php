<?php

namespace App\Http\Controllers;

use App\Models\Pusat;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PromosiPusatController extends Controller
{
    public function index(Pusat $pusat)
    {
        $data['cart']         = Cart::content();
        $data['datapusat']    = Pusat::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.pusat.detailpusat', compact('pusat'), $data);
    }
}
