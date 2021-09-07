<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\DetailRiwayat;
use App\Models\Guide;
use App\Models\Riwayat;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosiGuideController extends Controller
{
    public function index(Guide $guide)
    {
        $data['cart']       = Cart::content();
        $data['dataguide']  = Guide::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.guide.detailguide', compact('guide'), $data);
    }
}
