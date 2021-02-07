<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\Pusat;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosiPusatController extends Controller
{
    public function index()
    {
        $data['lasted'] = DB::table('riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.pusat.boordingpusat', $data);
    }

    public function create()
    {
        $data['riwayat'] = DB::table('riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.pusat.bookcartpusat', $data);
    }

    public function store(Pusat $pusat, Request $request)
    {
        $potongan = 100;
        $harga = $pusat->harga;
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
            'nama_pilihan'          => $pusat->nama,
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
        return redirect()->route('createpusat');
    }

    public function show(Pusat $pusat)
    {
        return view('paketbook.pusat.detailpusat', compact('pusat'));
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
        $pusat = Pusat::where('user_id', $riwayat->user_id_owner)->get();
        foreach ($pusat as $pusat) {
            $id = $pusat->user_id;
        }
        if ($id == $riwayat->user_id_owner) {
            event(new MyEvent($request->namalengkap . 'Memesan' . $riwayat->nama_pilihan));
        }
        return redirect()->route('showbordingpusat');
    }

    public function boording(Request $request)
    {
        $total = $request->jumlah_rating + $request->rating;
        Pusat::where('nama', $request->nama)
            ->update([
                'rating' => $total
            ]);
        return redirect('/');
    }
}
