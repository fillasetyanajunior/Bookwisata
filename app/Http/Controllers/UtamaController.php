<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Destinasi;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\Informasi;
use App\Models\Kapal;
use App\Models\Kuliner;
use App\Models\Mobil;
use App\Models\Paket;
use App\Models\Pusat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtamaController extends Controller
{
    public function index()
    {
        $data['destinasi']  = Destinasi::paginate(9);
        $data['mobil']      = Mobil::paginate(3);
        $data['bus']        = Bus::paginate(3);
        $data['destinasi']  = Destinasi::paginate(3);
        $data['kuliner']    = Kuliner::paginate(3);
        $data['hotel']      = Hotel::paginate(3);
        $data['pusat']      = Pusat::paginate(3);
        $data['guide']      = Guide::paginate(3);
        $data['kapal']      = Kapal::paginate(3);
        $data['paket']      = Paket::paginate(3);
        $data['info']       = Informasi::paginate(3);   
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
        $paket = Guide::orderBy('nama')->paginate(30);
        return view('catagories.guide',compact('guide'));
    }
    public function ListOfPaket()
    {
        $paket = Paket::orderBy('nama')->paginate(30);
        return view('catagories.paket',compact('paket'));
    }

    public function Pencarian(Request $request)
    {
        if ($request->pencarian != null) {    
            $bus        = DB::table('bus')->where('nama', 'like', "%" . $request->pencarian . "%")->first();
            $mobil      = DB::table('mobil')->where('nama', 'like', "%" . $request->pencarian . "%")->first();
            $destinasi  = DB::table('destinasi')->where('nama', 'like', "%" . $request->pencarian . "%")->first();
            $pusat      = DB::table('pusat')->where('nama', 'like', "%" . $request->pencarian . "%")->first();
            $kuliner    = DB::table('kuliner')->where('nama', 'like', "%" . $request->pencarian . "%")->first();
            $hotel      = DB::table('hotel')->where('nama', 'like', "%" . $request->pencarian . "%")->first();
            $kapal      = DB::table('kapal')->where('nama', 'like', "%" . $request->pencarian . "%")->first();
            $guide      = DB::table('guide')->where('nama', 'like', "%" . $request->pencarian . "%")->first();
            $paket      = DB::table('paket')->where('nama', 'like', "%" . $request->pencarian . "%")->first();
            if (null != $hotel) {
                $data['nama'] = 'hotel';
                return view('home.pencarian',['data' => $hotel],$data);
            } else if (null != $kuliner) {
                $data['nama'] = 'kuliner';
                return view('home.pencarian', ['data' => $kuliner], $data);
            } else if (null != $guide) {
                $data['nama'] = 'guide';
                return view('home.pencarian', ['data' => $guide], $data);
            } else if (null != $pusat) {
                $data['nama'] = 'pusat';
                return view('home.pencarian', ['data' => $pusat], $data);
            } else if (null != $destinasi) {
                $data['nama'] = 'destinasi';
                return view('home.pencarian', ['data' => $destinasi], $data);
            } else if (null != $paket) {
                $data['nama'] = 'paket';
                return view('home.pencarian', ['data' => $paket], $data);
            } else if (null != $mobil) {
                $data['nama'] = 'mobil';
                return view('home.pencarian', ['data' => $mobil], $data);
            } else if (null != $bus) {
                $data['nama'] = 'bus';
                return view('home.pencarian', ['data' => $bus], $data);
            } else if (null != $kapal) {
                $data['nama'] = 'kapal';
                return view('home.pencarian', ['data' => $kapal], $data);
            } else {
                $data['buss']        = DB::table('bus')->where('kota_search', 'like', "%" . $request->pencarian . "%")->get();
                $data['mobils']      = DB::table('mobil')->where('kota_search', 'like', "%" . $request->pencarian . "%")->get();
                $data['destinasis']  = DB::table('destinasi')->where('kota_search', 'like', "%" . $request->pencarian . "%")->get();
                $data['pusats']      = DB::table('pusat')->where('kota_search', 'like', "%" . $request->pencarian . "%")->get();
                $data['kuliners']    = DB::table('kuliner')->where('kota_search', 'like', "%" . $request->pencarian . "%")->get();
                $data['hotels']      = DB::table('hotel')->where('kota_search', 'like', "%" . $request->pencarian . "%")->get();
                $data['kapals']      = DB::table('kapal')->where('kota_search', 'like', "%" . $request->pencarian . "%")->get();
                $data['guides']      = DB::table('guide')->where('kota_search', 'like', "%" . $request->pencarian . "%")->get();
                $data['pakets']      = DB::table('paket')->where('kota_search', 'like', "%" . $request->pencarian . "%")->get();
                return view('home.pencariankota', $data);
            }
        } else {
            return redirect('/')->with('status', 'Pilihan Anda Tidak Ada');
        }
    }
}
