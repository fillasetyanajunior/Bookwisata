<?php

namespace App\Http\Controllers;

use App\Mail\BordingpassMail;
use App\Mail\KonfirmasiMail;
use App\Models\DetailRiwayat;
use App\Models\Riwayat;
use App\Models\Tipekamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RiwayatController extends Controller
{
    public function index()
    {
        if(request()->user()->role == 1){
            $data['riwayat'] = DB::table('riwayat')
                                ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                                ->get();
        } else if (request()->user()->role == 2) {
            $data['riwayat'] = DB::table('riwayat')
                                ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                                ->where('riwayat.user_id_owner', request()->user()->id)
                                ->get();
        }else{
            $data['riwayat'] = DB::table('riwayat')
                                ->join('detail_riwayat','detail_riwayat.id','=','riwayat.id_detail_riwayat')
                                ->where('riwayat.user_nama_customer', request()->user()->name)
                                ->get();
        }
        $data['tipe']   = Tipekamar::all();
        $data['title']  = 'Riwayat';
        return view('riwayat.riwayat',$data);
    }

    public function edit(Riwayat $riwayat)
    {
        $data['riwayat'] = DB::table('riwayat')
                            ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                            ->where('riwayat.id_detail_riwayat', $riwayat->id_detail_riwayat)
                            ->get();
        $data['title']  = 'Riwayat';
        return view('riwayat.riwayatkonfirmasi', $data);
    }

    public function update(Request $request, Riwayat $riwayat)
    {
        $ceks = DB::table('riwayat')
                    ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                    ->orderBy('user_nama_customer','ASC')
                    ->where('user_nama_customer',$riwayat->user_nama_customer)
                    ->get();

        $cek[] = null;
        foreach($ceks as $items){
            $cek = $items;
        }

        if($cek->waktu_payment == null || $cek->is_active == 1 || $cek->is_active == 2 || $cek->is_active == 3){
            if ($request->waktu_payment) {
                Riwayat::where('id', $riwayat->id)
                    ->update([
                        'is_active' => $request->is_active,
                        'waktu_payment' => $request->waktu_payment,
                    ]);
                
            }else{
                if ($request->is_active == 2) {
                    
                    if ($request->time_payment == 1) {
                        Riwayat::where('id',$riwayat->id)
                                ->update([
                                    'is_active'     => $request->is_active,
                                    'waktu_payment' => date('Y-m-d h:i:s', strtotime('+4 hour'))
                                ]);
                    } else if ($request->time_payment == 2) {
                        Riwayat::where('id',$riwayat->id)
                                ->update([
                                    'is_active'     => $request->is_active,
                                    'waktu_payment' => date('Y-m-d h:i:s', strtotime('+12 hour'))
                                ]);
                    }else{
                        Riwayat::where('id', $riwayat->id)
                            ->update([
                                'is_active'     => $request->is_active,
                                'waktu_payment' => date('Y-m-d h:i:s', strtotime('+24 hour'))
                            ]);
                    }

                    Mail::to($cek->email)->send(new KonfirmasiMail($riwayat->id));
                    
                } elseif($request->is_active == 3){

                    Riwayat::where('id', $riwayat->id)
                        ->update([
                            'is_active'     => $request->is_active,
                            'waktu_payment' => null,
                        ]);
                    Mail::to($cek->email)->send(new BordingpassMail($riwayat->id,$cek->nama));
                } else {
                    Riwayat::where('id', $riwayat->id)
                            ->update([
                                'is_active' => $request->is_active,
                                'waktu_payment' => null,
                    ]);
                }
            }
            return redirect()->route('riwayat')->with('status','Pesanan Telah Di Konfirmasi');
        }else{
            return redirect()->route('riwayat')->with('status','Pesanan Gagal Di Konfirmasi');
        }
    }

    public function show(Riwayat $riwayat)
    {
        $data['title']      = 'Detail Transaksi';
        $data['riwayat']    = DetailRiwayat::where('id',$riwayat->id_detail_riwayat)->first();
        return view('riwayat.showdetailriwayat',$data);
    }
    
}
