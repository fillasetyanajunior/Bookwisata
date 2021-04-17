<?php

namespace App\Http\Controllers;

use App\Mail\KonfirmasiMitra;
use App\Models\TransaksiMitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TransaksiMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']      = 'Transaksi Mitra';
        $data['transaksi']  = TransaksiMitra::all();
        return view('mitra.showtransaksi',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('mitra.form',compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->alamat != null) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $kode = substr(str_shuffle($permitted_chars), 0, 6);
            TransaksiMitra::create([
                'kode_transaksi'=> $kode,
                'nama'          => $request->nama,
                'email'         => $request->email,
                'nomer'         => $request->nomerhp,
                'alamat'        => $request->alamat,
                'paket_mitra'   => $request->paket_mitra,
                'harga'         => $request->harga,
                'waktu_payment' => date('Y-m-d h:i:s', strtotime('+24 hour')),
            ]);
            Mail::to($request->email)->send(new KonfirmasiMitra($kode));
            return redirect('/')->with('status','Pesanan Layanan Mitra Berhasil Silhakn Cek Email Anda Untuk Melakukan Pembayaran');
        } else {
            return redirect('/')->with('status', 'Pesanan Layanan Mitra Gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransaksiMitra  $transaksiMitra
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiMitra $transaksiMitra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransaksiMitra  $transaksiMitra
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiMitra $transaksiMitra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransaksiMitra  $transaksiMitra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransaksiMitra $transaksiMitra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransaksiMitra  $transaksiMitra
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiMitra $transaksiMitra)
    {
        //
    }
}
