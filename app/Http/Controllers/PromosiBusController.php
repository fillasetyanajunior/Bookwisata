<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PromosiBusController extends Controller
{
    public function index(Bus $bus)
    {
        $data['cart']       = Cart::content();
        $data['databus']    = Bus::orderBy('created_at','DESC')->paginate(3);
        return view('paketbook.bus.detailbus', compact('bus'),$data);
    }
}
