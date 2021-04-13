<?php

namespace App\Http\Controllers;

use App\Models\TransaksiMitra;
use Illuminate\Http\Request;

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
            TransaksiMitra::create([
                'nama'          => $request->nama,
                'email'         => $request->email,
                'nomer'         => $request->nomerhp,
                'alamat'        => $request->alamat,
                'paket_mitra'   => $request->paket_mitra,
                'waktu_payment' => date('Y-m-d h:i:s', strtotime('+24 hour')),
            ]);
            return redirect('/')->with('status','Pesanan Layanan Mitra Berhasil');
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
