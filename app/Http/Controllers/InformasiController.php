<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Informasi';
        $data['informasi'] = Informasi::paginate(10);
        return view('admin.informasi.showinformasi',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Informasi';
        return view('admin.informasi.createinformasi', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required',
            'informasi'         => 'required',
        ]);

        Informasi::create([
            'title'             => $request->title,
            'informasi'         => $request->informasi,
        ]);
        return redirect()->route('informasi')->with('status','Tambah Informasi Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function show(Informasi $informasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Informasi $informasi)
    {
        $data['title'] = 'Update Informasi';
        return view('admin.informasi.updateinformasi', $data,compact('informasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Informasi $informasi)
    {
        Informasi::where('id',$informasi->id)
                ->update([
                'title'             => $request->title,
                'informasi'         => $request->informasi,
        ]);
        return redirect()->route('informasi')->with('status', 'Update Informasi Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informasi $informasi)
    {
        Informasi::destroy($informasi->id);
        return redirect()->route('informasi')->with('status', 'Delete Informasi Berhasil');
    }
}
