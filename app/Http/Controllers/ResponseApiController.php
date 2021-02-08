<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResponseApiController extends Controller
{
    public function kabupaten(Request $request)
    {
        $request->only('id');
        $url = Http::get('http://dev.farizdotid.com/api/daerahindonesia/kota',[
            'id_provinsi' => $request->id
        ])->json();
        foreach($url['kota_kabupaten'] as $kab){
            $kota[] = [
                'id'    => $kab['id'],
                'nama'  => $kab['nama']
            ];
        }
        return response()->json([
            'status'    => 'ok',
            'kota'      => $kota
        ]);
    }
}
