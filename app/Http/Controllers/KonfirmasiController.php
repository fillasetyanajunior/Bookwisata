<?php

namespace App\Http\Controllers;

use App\Models\Konfirmasi;
use App\Models\KonfirmasiPembayaran;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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
            'qr_kode'           => 'required',
            'filekonfirmasi'    => 'required',
            'pilihan_konfirmasi'=> 'required',
        ]);

        $file = $request->file('filekonfirmasi');

        $name = time() . rand(1,100) . '.' . $file->extension();
        $file->storeAs('konfirmasi',$name);

        $id_owner = Riwayat::where('qr_code',$request->qr_kode)->first();

        if ($request->pilihan_konfirmasi == 1) {
            Konfirmasi::create([
                'id_owner'          => $id_owner->user_id_owner,
                'id_user'           => request()->user()->id,
                'nama'              => $request->nama_produk,
                'qrcode'            => $request->qr_kode,
                'filekonfirmasi'    => $name,
            ]);
        }else{
            KonfirmasiPembayaran::create([
                'id_user'           => request()->user()->id,
                'nama'              => $request->nama_produk,
                'kode'              => $request->qr_kode,
                'filekonfirmasi'    => $name,
            ]);
        }
        return redirect('konfirmasi_pembayaran')->with('status','Konfirmasi Telah Dikirim Mohon Tunggu Beberapa Menit Untuk Mengeceknya');
    }
    public function index()
    {
        $data['title'] = 'Konfirmasi Pembayaran';
        if (request()->user()->role == 1) {
            $data['konfirmasi'] = Konfirmasi::all();
            $data['mitra'] = KonfirmasiPembayaran::all();
        }elseif(request()->user()->role == 2){
            $data['konfirmasi'] = Konfirmasi::where('id_user',request()->user()->id)->get();
            $data['konfirmasi_unit'] = Konfirmasi::where('id_owner',request()->user()->id)->get();
            $data['mitra'] = KonfirmasiPembayaran::where('id_user',request()->user()->id)->get();
        }else{
            $data['konfirmasi'] = Konfirmasi::where('id_user',request()->user()->id)->get();
            $data['mitra'] = KonfirmasiPembayaran::where('id_user',request()->user()->id)->get();
        }
        return view('konfirmasipembayaran.show', $data);
    }
    public function showValidasi(Konfirmasi $konfirmasi)
    {
        $data['title'] = 'Validasi Pembayaran';
        return view('konfirmasipembayaran.validasipembayaran',$data,compact('konfirmasi'));
    }
    public function showValidasiMitra(KonfirmasiPembayaran $konfirmasipembayaran)
    {
        $data['title'] = 'Validasi Pembayaran';
        return view('konfirmasipembayaran.validasimitra',$data,compact('konfirmasipembayaran'));
    }
    public function downloadMitra(KonfirmasiPembayaran $konfirmasipembayaran)
    {
        $filepath = public_path('storage/konfirmasi/' . $konfirmasipembayaran->filekonfirmasi);
        return Response::download($filepath);
    }
    public function downloadPembayaran(Konfirmasi $konfirmasi)
    {
        $filepath = public_path('storage/konfirmasi/' . $konfirmasi->filekonfirmasi);
        return Response::download($filepath);
    }
}
