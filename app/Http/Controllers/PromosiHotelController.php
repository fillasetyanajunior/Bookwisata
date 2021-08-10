<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\DetailRiwayat;
use App\Models\Hotel;
use App\Models\Riwayat;
use App\Models\Tipekamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosiHotelController extends Controller
{
    public function index()
    {
        $data['lasted'] = DB::table('riwayat')
                            ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        $data['tipe'] = Tipekamar::all();
        return view('paketbook.hotel.boordinghotel', $data);
    }

    public function create()
    {
        $data['riwayat'] = DB::table('riwayat')
                            ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        $data['tipe'] = Tipekamar::all();
        $data['tips'] = Tipekamar::all();
        return view('paketbook.hotel.bookcarthotel', $data);
    }

    public function store(Hotel $hotel, Request $request)
    {
        $request->validate([
            'hari'      => 'required',
            'date'      => 'required',
            'pesanan'   => 'required'
        ]);

        $potongan = 25000;
        $harga = $hotel->harga;
        $hari = $request->hari;
        $pesanan = $request->pesanan;
        $durasi = 24 * $hari;

        $jumlah = ($harga * $hari * $pesanan) + $potongan;
        $detail_riwayat = DetailRiwayat::create([
            'nama'                  => "",
            'email'                 => "",
            'nomerhp'               => "",
            'nama_pilihan'          => $hotel->nama,
            'tipe'                  => $hotel->tipe,
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
        return redirect()->route('createhotel');
    }

    public function show(Hotel $hotel)
    {
        $data['tipe'] = Tipekamar::all();
        return view('paketbook.hotel.detailhotel', compact('hotel'),$data);
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

        $hotel = Hotel::where('user_id', $riwayat->user_id_owner)->first();
        if ($hotel->id == $riwayat->user_id_owner) {
            event(new MyEvent($request->namalengkap . 'Memesan' . $riwayat->nama_pilihan, $hotel->id));
        }
        return redirect()->route('showbordinghotel');
    }

    public function boording(Request $request)
    {
        $total = $request->jumlah_rating + $request->rating;
        Hotel::where('nama', $request->nama)
            ->Where('tipe', $request->tipe)
            ->update([
                'rating' => $total
            ]);
        return redirect('/');
    }
}
