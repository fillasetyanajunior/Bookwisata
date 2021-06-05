<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MyEvent;
use App\Models\DetailRiwayat;
use App\Models\Sepeda;
use App\Models\Riwayat;
use Illuminate\Support\Facades\DB;


class PromosiSepedaController extends Controller
{
    public function index()
    {
        $data['lasted'] = DB::table('riwayat')
                            ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.sepeda.boordingsepeda', $data);
    }

    public function create()
    {
        $data['riwayat'] = DB::table('riwayat')
                            ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.sepeda.bookcartsepeda', $data);
    }

    public function store(Sepeda $sepeda, Request $request)
    {
        $potongan = 100000;
        $harga = $sepeda->harga;
        $hari = $request->hari;
        $pesanan = $request->pesanan;
        $durasi = 24 * $hari;

        $jumlah = ($harga * $hari * $pesanan) + $potongan;
        $detail_riwayat = DetailRiwayat::create([
            'nama'                  => "",
            'email'                 => "",
            'nomerhp'               => "",
            'nama_pilihan'          => $sepeda->nama,
            'tipe'                  => $sepeda->tipe,
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
            'company'               => $sepeda->company,
            'id_detail_riwayat'     => $detail_riwayat->id,
            'is_active'             => 1
        ]);
        return redirect()->route('createsepeda');
    }

    public function show(Sepeda $sepeda)
    {
        return view('paketbook.sepeda.detailsepeda', compact('sepeda'));
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

        $sepeda = Sepeda::where('user_id', $riwayat->user_id_owner)->first();
        if ($sepeda->id == $riwayat->user_id_owner) {
            event(new MyEvent($request->namalengkap . 'Memesan' . $riwayat->nama_pilihan, $sepeda->id));
        }
        return redirect()->route('showbordingsepeda');
    }

    public function boording(Request $request)
    {
        $total = $request->jumlah_rating + $request->rating;
        Sepeda::where('nama', $request->nama)
            ->update([
                'rating' => $total
            ]);
        return redirect('/');
    }
}
