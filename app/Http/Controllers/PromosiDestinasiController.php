<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\Destinasi;
use App\Models\DetailRiwayat;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosiDestinasiController extends Controller
{
    public function index()
    {
        $data['lasted'] = DB::table('riwayat')
                            ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.destinasi.boordingdestinasi', $data);
    }

    public function create()
    {
        $data['riwayat'] = DB::table('riwayat')
                            ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.destinasi.bookcartdestinasi', $data);
    }

    public function store(Destinasi $destinasi, Request $request)
    {
        $potongan = 100000;
        $harga = $destinasi->harga;
        $hari = $request->hari;
        $pesanan = $request->pesanan;
        $durasi = 24 * $hari;

        $jumlah = ($harga * $hari * $pesanan) + $potongan;
        $detail_riwayat = DetailRiwayat::create([
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
        ]);
        Riwayat::create([
            'user_nama_customer'    => request()->user()->name,
            'user_id_owner'         => $request->hidden,
            'id_detail_riwayat'     => $detail_riwayat->id,
            'is_active'             => 1
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

        $rwt = Riwayat::where('id', $riwayat->id)->first();
        DetailRiwayat::where('id', $rwt->id_detail_riwayat)
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

        $destinasi = Destinasi::where('user_id', $riwayat->user_id_owner)->first();
        if ($destinasi->id == $riwayat->user_id_owner) {
            event(new MyEvent($request->namalengkap . 'Memesan' . $riwayat->nama_pilihan, $destinasi->id));
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
