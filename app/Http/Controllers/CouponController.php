<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $data['title'] = 'Coupon';
        $data['coupon'] = Coupon::paginate(20);
        return view('admin.coupon.coupon',$data);
    }
    public function store(Request $request)
    {
        for ($i=1; $i < $request->coupon ; $i++) {
            $coupon = \Str::random(20);

            Coupon::create([
                'kode' => $coupon,
                'potongan' => $request->potongan
            ]);
        }
        return redirect()->back()->with('status','Coupon Success');
    }
}
