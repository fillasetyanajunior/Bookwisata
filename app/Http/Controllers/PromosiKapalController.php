<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PromosiKapalController extends Controller
{
    public function index(Kapal $kapal)
    {
        $data['cart']       = Cart::content();
        $data['datakapal']  = Kapal::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.kapal.detailkapal', compact('kapal'), $data);
    }
}
