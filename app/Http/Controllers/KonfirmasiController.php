<?php

namespace App\Http\Controllers;

use App\Models\Konfirmasi;
use Illuminate\Http\Request;

class KonfirmasiController extends Controller
{
    public function create()
    {
        $data['title']  = 'Form Konfrimasi';
        return view('konfirmasipembayaran.konfirmasipembayaran',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'       => 'required',
            'qrkode'            => 'required',
            'filekofrimasi'     => 'required',
        ]);

        $file = $request->file('filekonfirmasi');

        $name = time() . rand(1,100) . '.' . $file->extension();
        $file->storeAs('konfirmasi',$name);

        Konfirmasi::create([
            'id_user'  => request()->user()->id,
            'nama'  => $request->nama_produk,
            'qrcode'  => $request->qr_kode,
            'filekonfirmasi'  => $name,
        ]);
        return redirect('konfirmasi')->with('status','Konfirmasi Telah Dikirim Tolong Tunggu Beberapa Menit Untuk Mengeceknya');
    }
    public function index()
    {
        $data['title'] = 'Konfirmasi Pembayaran';
        if (request()->user()->role == 1) {
            $data['konfirmasi'] = Konfirmasi::all();
        }elseif(request()->user()->role == 3){
            $data['konfirmasi'] = Konfirmasi::where('id_user',request()->user()->id)->get();
        }
        return view('konfirmasipembayaran.show', $data);
    }
}
