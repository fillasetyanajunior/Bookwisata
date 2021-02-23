<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Tipekamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index()
    {
        if(request()->user()->role == 1){
            $data['riwayat'] = Riwayat::all();
        } else if (request()->user()->role == 2) {
            $data['riwayat'] = Riwayat::where('riwayat.user_id_owner', request()->user()->id)->get();
        }else{
            $data['riwayat'] = Riwayat::where('riwayat.user_nama_customer', request()->user()->name)->get();
        }
        $data['tipe']   = Tipekamar::all();
        $data['title']  = 'Riwayat';
        return view('home.riwayat',$data);
    }

    public function edit(Riwayat $riwayat)
    {
        $data['title'] = 'Riwayat';
        return view('home.riwayatkonfirmasi', $data, compact('riwayat'));
    }

    public function update(Request $request, Riwayat $riwayat)
    {
        if (!$request->waktu_payment) {
            if ($request->is_active == 2) {
                Riwayat::where('id',$riwayat->id)
                        ->update([
                            'is_active' => $request->is_active,
                            'waktu_payment' => 1800,
                        ]);
            } else {
                Riwayat::where('id', $riwayat->id)
                        ->update([
                            'is_active' => $request->is_active,
                            'waktu_payment' => 0,
                ]);
            }
            
        }else{
            Riwayat::where('id', $riwayat->id)
                ->update([
                    'is_active' => $request->is_active,
                    'waktu_payment' => $request->waktu_payment,
                ]);
        }
        return redirect()->route('riwayat')->with('status','Pesanan Telah Di Konfirmasi');
    }
}
