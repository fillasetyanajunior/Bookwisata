<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PromosiDestinasiController extends Controller
{
    public function index(Destinasi $destinasi)
    {
        $data['cart']           = Cart::content();
        $data['datadestinasi']  = Destinasi::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.destinasi.detaildestinasi', compact('destinasi'),$data);
    }
}
