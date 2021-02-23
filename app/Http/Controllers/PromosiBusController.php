<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\Bus;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromosiBusController extends Controller
{
    public function index()
    {
        $data['lasted'] = DB::table('riwayat')
                            ->where('user_nama_customer', '=', request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('paketbook.bus.boordingbus',$data);
    }
    
    public function create()
    {
        $data['riwayat'] = DB::table('riwayat')
                            ->where('user_nama_customer','=',request()->user()->name)
                            ->limit('1')
                            ->orderBy('created_at','DESC')
                            ->get();
        return view('paketbook.bus.bookcartbus', $data);
    }
    
    public function store(Bus $bus, Request $request)
    {
        $potongan = 100;
        $harga = $bus->harga;
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
            'nama_pilihan'          => $bus->nama,
            'tipe'                  => $bus->tipe,
            'jumlah_sit'            => $bus->jumlah_sit,
            'harga'                 => $harga,
            'jumlahpesanan'         => $pesanan,
            'durasi'                => $durasi,
            'potongan'              => $potongan,
            'hari'                  => $hari,
            'date'                  => $request->date,
            'total'                 => $jumlah,
            'is_active'             => 1
        ]);
        return redirect()->route('createbus');
    }
    
    public function show(Bus $bus)
    {
        return view('paketbook.bus.detailbus', compact('bus'));
    }
    
    public function update(Request $request,Riwayat $riwayat)
    {
        $validatedData  = $request->validate([
            'name'          => 'required',
            'nomerhp'       => 'required',
            'email'         => 'required',
            'namalengkap'   => 'required',
        ]);
        Riwayat::where('id',$riwayat->id)
                ->update([
                    'nama'      => $request->namalengkap,
                    'nomerhp'   =>$request->nomerhp,
                    'email'     => $request->email
        ]);
        $id = null;
        $bus = Bus::where('user_id',$riwayat->user_id_owner)->get();
        foreach($bus as $bus)
        {
            $id = $bus->user_id;
        }
        if($id == $riwayat->user_id_owner)
        {
            event(new MyEvent($request->namalengkap . 'Memesan' . $riwayat->nama_pilihan,$id));
        }
        return redirect()->route('showbordingbus');
    }

    public function boording(Request $request)
    {
        $total = $request->jumlah_rating + $request->rating;
        Bus::where('nama',$request->nama)
            ->Where('tipe',$request->tipe)
            ->update([
                'rating' => $total
            ]);
        return redirect('/');
    }
}
