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
}
