<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['destinasi']  = Destinasi::all();
        $data['title']      = 'Posting Destinasi';
        return view('admin.promosi.destinasi.showdestinasi', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Destinasi';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.destinasi.createdestinasi', compact('response'), $data);
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
            'alamat'    => 'required',
            'review'    => 'required',
            'harga'     => 'required',
            'gambar'    => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('destinasi', $name);

            FileUpload::create([
                'nama' => $request->nama,
                'foto' => $name,
            ]);
        }

        Destinasi::create([
            'user_id'   => request()->user()->id,
            'nama'      => $request->nama,
            'provinsi'  => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'alamat'    => $request->alamat,
            'review'    => $request->review,
            'harga'     => $request->harga,
            'rating'    => 0,
        ]);

        return redirect('destinasi')->with('status', 'Postingan Destinasi Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function show(Destinasi $destinasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Destinasi $destinasi)
    {
        $data['title']      = 'Update Posting Destinasi';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.destinasi.updatedestinasi', compact('destinasi'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destinasi $destinasi)
    {
        $validatedData  = $request->validate([
            'kabupaten' => 'required',
        ]);
        if ($request->hasfile('gambar')) {
            $request->validate([
                'gambar' => 'image|mimes:jpg,jpeg,png'
            ]);
            $filegambar = DB::table('fileuploads')
            ->where('destinasi', '=', $destinasi->nama)
                ->get();
            foreach ($filegambar as $gambar) {
                Storage::delete('destinasi/' . $gambar->foto);
            }
            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('destinasi', $name);

                FileUpload::where('nama', $destinasi->nama)
                    ->update([
                        'nama' => $request->nama,
                        'foto' => $name,
                    ]);
            }

            Destinasi::where('id', $destinasi->id)
                ->update([
                    'nama'      => $request->nama,
                    'provinsi'  => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'alamat'    => $request->alamat,
                    'review'    => $request->review,
                    'harga'     => $request->harga,
                ]);
        } else {
            FileUpload::where('nama', $destinasi->nama)
                ->update([
                    'nama'      => $request->nama
                ]);
            Destinasi::where('id', $destinasi->id)
                ->update([
                    'nama'      => $request->nama,
                    'provinsi'  => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'alamat'    => $request->alamat,
                    'review'    => $request->review,
                    'harga'     => $request->harga,
                ]);
        }
        return redirect('destinasi')->with('status', 'Postingan Destinasi Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destinasi $destinasi)
    {
        $filegambar = DB::table('fileuploads')
        ->where('nama', '=', $destinasi->nama)
            ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('destinasi/' . $gambar->foto);
        }
        FileUpload::where('nama', $destinasi->nama)->delete();
        Destinasi::destroy($destinasi->id);
        return redirect('destinasi')->with('status', 'Postingan Destinasi Berhasil Di Hapus');
    }
}
