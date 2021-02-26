<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Destinasi;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\Kapal;
use App\Models\Kuliner;
use App\Models\Mobil;
use App\Models\Paket;
use App\Models\Pusat;
use App\Models\User;
use Illuminate\Http\Request;

class UtamaController extends Controller
{
    public function index()
    {
        $data['destinasi'] = Destinasi::paginate(9);
        $data['mobil'] = Mobil::paginate(3);
        $data['bus'] = Bus::paginate(3);
        $data['destinasi']=Destinasi::paginate(3);
        $data['kuliner'] = Kuliner::paginate(3);
        $data['hotel']=Hotel::paginate(3);
        $data['pusat']=Pusat::paginate(3);
        $data['guide']=Guide::paginate(3);
        $data['kapal'] = Kapal::paginate(3);
        $data['paket']=Paket::paginate(3);
        return view('home.utama',$data);
    }
    public function ListOfBus()
    {
        $bus = Bus::orderBy('nama')->paginate(30);
        return view('catagories.bus',compact('bus'));
    }
    public function ListOfMobil()
    {
        $mobil = Mobil::orderBy('nama')->paginate(30);
        return view('catagories.mobil',compact('mobil'));
    }
    public function ListOfDestinasi()
    {
        $destinasi = Destinasi::orderBy('nama')->paginate(30);
        return view('catagories.destinasi',compact('destinasi'));
    }
    public function ListOfPusat()
    {
        $pusat = Pusat::orderBy('nama')->paginate(30);
        return view('catagories.pusat',compact('pusat'));
    }
    public function ListOfKuliner()
    {
        $kuliner = Kuliner::orderBy('nama')->paginate(30);
        return view('catagories.kuliner',compact('kuliner'));
    }
    public function ListOfHotel()
    {
        $hotel = Hotel::orderBy('nama')->paginate(30);
        return view('catagories.hotel',compact('hotel'));
    }
    public function ListOfKapal()
    {
        $kapal = Kapal::orderBy('nama')->paginate(30);
        return view('catagories.kapal',compact('kapal'));
    }
    public function ListOfGuide()
    {
        $guide = Guide::orderBy('nama')->paginate(30);
        return view('catagories.guide',compact('guide'));
    }
    public function ListOfPaket()
    {
        $paket = Paket::orderBy('nama')->paginate(30);
        return view('catagories.paket',compact('paket'));
    }

    public function StoreLayananMitra(Request $request)
    {
        if ($request->id == 1) {
           User::where('id',request()->user()->id)
                ->update([
                    'active_mitra'  =>  date('Y-m-d', strtotime('+3 month'))
                ]);
        } elseif ($request->id == 2) {
           User::where('id',request()->user()->id)
                ->update([
                    'active_mitra'  =>  date('Y-m-d', strtotime('+6 month'))
                ]);
        } elseif ($request->id == 3) {
           User::where('id',request()->user()->id)
                ->update([
                    'active_mitra'  =>  date('Y-m-d', strtotime('+2 year'))
                ]);
        } elseif ($request->id == 4) {
           User::where('id',request()->user()->id)
                ->update([
                    'active_mitra'  =>  date('Y-m-d', strtotime('+1 year'))
                ]);
        } else {
           return redirect('/')->with('status','Pilihan Tidak Ada');
        }
        return redirect('/')->with('status', 'Pesanan Telah Diterima Tolong Lakukan Pembayaran');
    }
}
