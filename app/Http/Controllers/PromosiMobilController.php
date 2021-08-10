<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\DetailRiwayat;
use App\Models\Mobil;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosiMobilController extends Controller
{
    public function index()
    {
        $data['lasted'] = DB::table('riwayat')
                            ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.mobil.boordingmobil', $data);
    }

    public function create()
    {
        $data['riwayat'] = DB::table('riwayat')
                            ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.mobil.bookcartmobil', $data);
    }

    public function store(Mobil $mobil, Request $request)
    {
        $request->validate([
            'hari'      => 'required',
            'date'      => 'required',
            'pesanan'   => 'required'
        ]);

        $potongan = 25000;
        $harga = $mobil->harga;
        $hari = $request->hari;
        $pesanan = $request->pesanan;
        $durasi = 24 * $hari;

        $jumlah = ($harga * $hari * $pesanan) + $potongan;
        $detail_riwayat = DetailRiwayat::create([
            'nama'                  => "",
            'email'                 => "",
            'nomerhp'               => "",
            'nama_pilihan'          => $mobil->nama,
            'tipe'                  => $mobil->tipe,
            'jumlah_sit'            => $mobil->jumlah_sit,
            'harga'                 => $harga,
            'jumlahpesanan'         => $pesanan,
            'durasi'                => $durasi,
            'potongan'              => $potongan,
            'hari'                  => $hari,
            'date'                  => $request->date,
            'total'                 => $jumlah,
        ]);
        Riwayat::create([
            'user_nama_customer'    => request()->user()->name,
            'user_id_owner'         => $request->hidden,
            'company'               => $mobil->company,
            'id_detail_riwayat'     => $detail_riwayat->id,
            'is_active'             => 1
        ]);
        return redirect()->route('createmobil');
    }

    public function show(Mobil $mobil)
    {
        return view('paketbook.mobil.detailmobil', compact('mobil'));
    }

    public function update(Request $request, Riwayat $riwayat)
    {
        $request->validate([
            'name'          => 'required',
            'nomerhp'       => 'required',
            'email'         => 'required',
            'namalengkap'   => 'required',
        ]);

        DetailRiwayat::where('id', $riwayat->id_detail_riwayat)
            ->update([
                'nama'      => $request->namalengkap,
                'nomerhp'   => $request->nomerhp,
                'email'     => $request->email,
            ]);

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $qr = substr(str_shuffle($permitted_chars), 0, 6);
        Riwayat::where('id', $riwayat->id)
            ->update([
                'qr_code'   => $qr,
                'note'      => $request->note
            ]);

        $mobil = Mobil::where('user_id', $riwayat->user_id_owner)->first();
        if ($mobil->id == $riwayat->user_id_owner) {
            event(new MyEvent($request->namalengkap . 'Memesan' . $riwayat->nama_pilihan, $mobil->id));
        }
        return redirect()->route('showbordingmobil');
    }

    public function boording(Request $request)
    {
        $total = $request->jumlah_rating + $request->rating;
        Mobil::where('nama', $request->nama)
            ->Where('tipe', $request->tipe)
            ->update([
                'rating' => $total
            ]);
        return redirect('/');
    }
}
