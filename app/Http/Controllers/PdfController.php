<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

;

class PdfController extends Controller
{
    public function PdfGenerate($id)
    {
        $data['riwayat'] = DB::table('riwayat')
                            ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                            ->where('riwayat.id', $id)
                            ->first();
        $pdf = PDF::loadview('home.boardingpass',$data);
        return $pdf->download('Boadringpass_Bookwisata.pdf');
    }
}
