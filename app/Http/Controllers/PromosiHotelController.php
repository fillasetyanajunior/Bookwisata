<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
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
        $potongan = 100;
        $harga = $hotel->harga;
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
        $hotel = Hotel::where('user_id', $riwayat->user_id_owner)->get();
        foreach ($hotel as $hotel) {
            $id = $hotel->user_id;
        }
        if ($id == $riwayat->user_id_owner) {
            event(new MyEvent($request->namalengkap . 'Memesan' . $riwayat->nama_pilihan, $id));
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
