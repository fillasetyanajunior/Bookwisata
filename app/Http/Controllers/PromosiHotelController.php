<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Tipekamar;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PromosiHotelController extends Controller
{
    public function index(Hotel $hotel)
    {
        $data['cart']       = Cart::content();
        $data['datahotel']  = Hotel::orderBy('created_at', 'DESC')->paginate(3);
        $data['tipe']       = Tipekamar::all();
        return view('paketbook.hotel.detailhotel', compact('hotel'), $data);
    }
}
