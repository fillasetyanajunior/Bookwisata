<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\Destinasi;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosiDestinasiController extends Controller
{
    public function index()
    {
        $data['lasted'] = DB::table('riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.destinasi.boordingdestinasi', $data);
    }

    public function create()
    {
        $data['riwayat'] = DB::table('riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.destinasi.bookcartdestinasi', $data);
    }

    public function store(Destinasi $destinasi, Request $request)
    {
        $potongan = 100;
        $harga = $destinasi->harga;
        $hari = $request->hari;
        $pesanan = $request->pesanan;
        $durasi = 24 * $hari;

        $jumlah = ($harga * $hari * $pesanan) + $potongan;
        Riwayat::create([
            'user_nama_customer' => request()->user()->name,
            'user_id_owner'     => $request->hidden,
            'nama'              => "",
            'email'             => "",
            'nomerhp'           => "",
            'nama_pilihan'      => $destinasi->nama,
            'tipe'              => '-',
            'jumlah_sit'        => '-',
            'harga'             => $harga,
            'jumlahpesanan'     => $pesanan,
            'durasi'            => $durasi,
            'potongan'          => $potongan,
            'hari'              => $hari,
            'date'              => $request->date,
            'total'             => $jumlah,
            'is_active'         => 1
        ]);
        return redirect()->route('createdestinasi');
    }

    public function show(Destinasi $destinasi)
    {
        return view('paketbook.destinasi.detaildestinasi', compact('destinasi'));
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
        $destinasi = Destinasi::where('user_id', $riwayat->user_id_owner)->get();
        foreach ($destinasi as $destinasi) {
            $id = $destinasi->user_id;
        }
        if ($id == $riwayat->user_id_owner) {
            event(new MyEvent($request->namalengkap . 'Memesan' . $riwayat->nama_pilihan));
        }
        return redirect()->route('showbordingdestinasi');
    }

    public function boording(Request $request)
    {
        $total = $request->jumlah_rating + $request->rating;
        Destinasi::where('nama', $request->nama)
            ->update([
                'rating' => $total
            ]);
        return redirect('/');
    }
}
