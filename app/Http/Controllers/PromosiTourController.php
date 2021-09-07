<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use Gloudemans\Shoppingcart\Facades\Cart;

class PromosiTourController extends Controller
{
    public function index(Tour $tour)
    {
        $data['cart']       = Cart::content();
        $data['datatour']   = Tour::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.tour.detailtour', compact('tour'), $data);
    }
}
