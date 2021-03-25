<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Kuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class KulinerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kuliner']    = Kuliner::all();
        $data['title']      = 'Posting Kuliner';
        return view('admin.promosi.kuliner.showkuliner', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Kuliner';
        $url            =  Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.kuliner.createkuliner', compact('response'), $data);
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
            'gambar.*'    => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('kuliner', $name);

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

        Kuliner::create([
            'user_id'       => request()->user()->id,
            'nama'          => $request->nama,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'alamat'        => $request->alamat,
            'review'        => $request->review,
            'harga'         => $request->harga,
            'rating'        => 0,
            'kota_search'   => $kota,
        ]);

        return redirect('kuliner')->with('status', 'Postingan Kuliner Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kuliner  $kuliner
     * @return \Illuminate\Http\Response
     */
    public function show(Kuliner $kuliner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kuliner  $kuliner
     * @return \Illuminate\Http\Response
     */
    public function edit(Kuliner $kuliner)
    {
        $data['title']      = 'Update Posting Kuliner';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.kuliner.updatekuliner', compact('kuliner'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kuliner  $kuliner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kuliner $kuliner)
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
            ->where('nama', '=', $kuliner->nama)
                ->get();
            foreach ($filegambar as $gambar) {
                Storage::delete('kuliner/' . $gambar->foto);
            }
            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('kuliner', $name);

                FileUpload::where('nama', $kuliner->nama)
                    ->update([
                        'nama' => $request->nama,
                        'foto' => $name,
                    ]);
            }

            Kuliner::where('id', $kuliner->id)
                ->update([
                'nama'          => $request->nama,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'alamat'        => $request->alamat,
                'review'        => $request->review,
                'harga'         => $request->harga,
                'kota_search'   => $kota,
                ]);
        } else {
            FileUpload::where('nama', $kuliner->nama)
                ->update([
                    'nama'  => $request->nama
                ]);
            Kuliner::where('id', $kuliner->id)
                ->update([
                'nama'          => $request->nama,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'alamat'        => $request->alamat,
                'review'        => $request->review,
                'harga'         => $request->harga,
                'kota_search'   => $kota,
                ]);
        }
        return redirect('kuliner')->with('status', 'Postingan Kuliner Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kuliner  $kuliner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kuliner $kuliner)
    {
        $filegambar = DB::table('fileuploads')
        ->where('nama', '=', $kuliner->nama)
            ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('kuliner/' . $gambar->foto);
        }
        FileUpload::where('nama', $kuliner->nama)->delete();
        Kuliner::destroy($kuliner->id);
        return redirect('kuliner')->with('status', 'Postingan Kuliner Berhasil Di Hapus');
    }
}
