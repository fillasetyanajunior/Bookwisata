<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['paket'] = Paket::all();
        $data['title'] = 'Posting Paket Wisata';
        return view('admin.promosi.paket.showpaket', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Paket Wisata';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.paket.createpaket', compact('response'), $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData  = $request->validate([
            'nama'      => 'required',
            'provinsi'  => 'required',
            'kabupaten' => 'required',
            'review'    => 'required',
            'harga'     => 'required',
            'gambar.*'    => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('paket', $name);

            FileUpload::create([
                'nama'  => $request->nama,
                'foto'  => $name,
            ]);
        }

        $url = Http::get('http://dev.farizdotid.com/api/daerahindonesia/kota', [
            'id_provinsi' => $request->provinsi
        ]);
        foreach ($url['kota_kabupaten'] as $kab) {
            if ($kab['id'] == $request->kabupaten) {
                $kota = $kab['nama'];
            }
        }

        Paket::create([
            'user_id'       => request()->user()->id,
            'nama'          => $request->nama,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'review'        => $request->review,
            'harga'         => $request->harga,
            'rating'        => 0,
            'kota_search'   => $kota,
        ]);

        return redirect('paket')->with('status', 'Postingan Paket Wisata Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        $data['title']      = 'Update Posting Paket Wisata';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.paket.updatepaket', compact('paket'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        $validatedData  = $request->validate([
            'kabupaten' => 'required',
        ]);

        $url = Http::get('http://dev.farizdotid.com/api/daerahindonesia/kota', [
            'id_provinsi' => $request->provinsi
        ]);
        foreach ($url['kota_kabupaten'] as $kab) {
            if ($kab['id'] == $request->kabupaten) {
                $kota = $kab['nama'];
            }
        }

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);
            
            $filegambar = DB::table('fileuploads')
                            ->where('nama', '=', $paket->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('paket/' . $gambar->foto));
            }

            FileUpload::where('nama', $paket->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('paket', $name);

                FileUpload::create([
                    'nama' => $request->nama,
                    'foto' => $name,
                ]);
            }

            Paket::where('id', $paket->id)
                ->update([
                    'nama'          => $request->nama,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'review'        => $request->review,
                    'harga'         => $request->harga,
                    'kota_search'   => $kota,
                ]);
        } else {
            FileUpload::where('nama', $paket->nama)
                ->update([
                    'nama'      => $request->nama
                ]);
            Paket::where('id', $paket->id)
                ->update([
                    'nama'          => $request->nama,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'review'        => $request->review,
                    'harga'         => $request->harga,
                    'kota_search'   => $kota,
                ]);
        }
        return redirect('paket')->with('status', 'Postingan Paket Wisata Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
        $filegambar = DB::table('fileuploads')
        ->where('nama', '=', $paket->nama)
            ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('paket/' . $gambar->foto);
        }
        FileUpload::where('nama', $paket->nama)->delete();
        Paket::destroy($paket->id);
        return redirect('paket')->with('status', 'Postingan Paket Wisata Berhasil Di Hapus');
    }
}
