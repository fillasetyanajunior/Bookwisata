<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camp;
use Gloudemans\Shoppingcart\Facades\Cart;

class PromosiCampController extends Controller
{
    public function index(Camp $camp)
    {
        $data['cart']       = Cart::content();
        $data['datacamp']    = Camp::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.camp.detailcamp', compact('camp'),$data);
    }
}
