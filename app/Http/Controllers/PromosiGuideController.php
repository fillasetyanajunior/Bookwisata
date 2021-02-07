<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\Guide;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosiGuideController extends Controller
{
    public function index()
    {
        $data['lasted'] = DB::table('riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.guide.boordingguide', $data);
    }

    public function create()
    {
        $data['riwayat'] = DB::table('riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.guide.bookcartguide', $data);
    }

    public function store(Guide $guide, Request $request)
    {
        $potongan = 100;
        $harga = $guide->harga;
        $hari = $request->hari;
        $pesanan = $request->pesanan;
        $durasi = 24 * $hari;

        $jumlah = ($harga * $hari * $pesanan) + $potongan;
        Riwayat::create([
            'user_nama_customer'    => request()->user()->name,
            'user_id_owner'         => $request->hidden,
            'nama'                  => "",
            'email'                 => "",
            'nomerhp'               => "",
            'nama_pilihan'          => $guide->nama,
            'tipe'                  => '-',
            'jumlah_sit'            => '-',
            'harga'                 => $harga,
            'jumlahpesanan'         => $pesanan,
            'durasi'                => $durasi,
            'potongan'              => $potongan,
            'hari'                  => $hari,
            'date'                  => $request->date,
            'total'                 => $jumlah,
            'is_active'             => 1
        ]);
        return redirect()->route('createguide');
    }

    public function show(Guide $guide)
    {
        return view('paketbook.guide.detailguide', compact('guide'));
    }

    public function update(Request $request, Riwayat $riwayat)
    {
        $validatedData  = $request->validate([
            'name'          => 'required',
            'nomerhp'       => 'required',
            'email'         => 'required',
            'namalengkap'   => 'required',
        ]);
        Riwayat::where('id', $riwayat->id)
            ->update([
                'nama'      => $request->namalengkap,
                'nomerhp'   => $request->nomerhp,
                'email'     => $request->email
            ]);
        $id = null;
        $guide = Guide::where('user_id', $riwayat->user_id_owner)->get();
        foreach ($guide as $guide) {
            $id = $guide->user_id;
        }
        if ($id == $riwayat->user_id_owner) {
            event(new MyEvent($request->namalengkap . 'Memesan' . $riwayat->nama_pilihan));
        }
        return redirect()->route('showbordingguide');
    }

    public function boording(Request $request)
    {
        $total = $request->jumlah_rating + $request->rating;
        Guide::where('nama', $request->nama)
            ->update([
                'rating' => $total
            ]);
        return redirect('/');
    }
}
