<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\DetailRiwayat;
use App\Models\Kuliner;
use App\Models\Riwayat;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosiKulinerController extends Controller
{
    public function index(Kuliner $kuliner)
    {
        $data['cart']           = Cart::content();
        $data['datakuliner']    = Kuliner::orderBy('created_at', 'DESC')->paginate(3);
        return view('paketbook.kuliner.detailkuliner', compact('kuliner'), $data);
    }

    public function store(Kuliner $kuliner, Request $request)
    {
        $request->validate([
            'hari'      => 'required',
            'date'      => 'required',
            'pesanan'   => 'required'
        ]);

        $potongan = 25000;
        $harga = $kuliner->harga;
        $hari = $request->hari;
        $pesanan = $request->pesanan;
        $durasi = 24 * $hari;

        $jumlah = ($harga * $hari * $pesanan) + $potongan;
        $detail_riwayat = DetailRiwayat::create([
            'nama'                  => "",
            'email'                 => "",
            'nomerhp'               => "",
            'nama_pilihan'          => $kuliner->nama,
            'tipe'                  => '-',
            'jumlah_sit'            => '-',
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
            'company'               => '-',
            'id_detail_riwayat'     => $detail_riwayat->id,
            'is_active'             => 1
        ]);
        return redirect()->route('createkuliner');
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

        $kuliner = Kuliner::where('user_id', $riwayat->user_id_owner)->first();
        if ($kuliner->id == $riwayat->user_id_owner) {
            event(new MyEvent($request->namalengkap . 'Memesan' . $riwayat->nama_pilihan, $kuliner->id));
        }
        return redirect()->route('showbordingkuliner');
    }

    public function boording(Request $request)
    {
        $total = $request->jumlah_rating + $request->rating;
        Kuliner::where('nama', $request->nama)
            ->update([
                'rating' => $total
            ]);
        return redirect('/');
    }
}
