<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepeda;
use Gloudemans\Shoppingcart\Facades\Cart;


class PromosiSepedaController extends Controller
{
    public function index(Sepeda $sepeda)
    {
        $data['cart']         = Cart::content();
        $data['datasepeda']   = Sepeda::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.sepeda.detailsepeda', compact('sepeda'), $data);
    }
}
