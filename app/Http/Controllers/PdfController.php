<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;;

class PdfController extends Controller
{
    public function PdfGenerate($id)
    {
        $riwayat = Riwayat::where('id',$id)->get();
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
