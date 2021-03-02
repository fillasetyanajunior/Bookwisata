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
        $riwayat = DB::table('riwayat')
                    ->join('detail_riwayat', 'detail_riwayat.id', '=', 'riwayat.id_detail_riwayat')
                    ->where('riwayat.id', $id)
                    ->get();
        $data[] = null;
        foreach($riwayat as $riwayats)
        {
            $data = $riwayats;
        }
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pdf = PDF::loadview('home.boardingpass', compact('data'),compact('permitted_chars'));
        return $pdf->download('Boadringpass_Bookwisata.pdf');
    }
}
