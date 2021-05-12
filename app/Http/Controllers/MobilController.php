<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['mobil'] = Mobil::all();
        $data['title'] = 'Posting Mobil';
        return view('admin.promosi.mobil.showmobil', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Mobil';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.mobil.createmobil', compact('response'), $data);
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
            'nama'          => 'required',
            'company'       => 'required',
            'provinsi'      => 'required',
            'kabupaten'     => 'required',
            'tipe'          => 'required',
            'transmisi'     => 'required',
            'ac'            => 'required',
            'overland'      => 'required',
            'jumlah_sit'    => 'required',
            'harga'         => 'required',
            'review'         => 'required',
            'gambar.*'      => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('mobil', $name);

            FileUpload::create([
                'nama' => $request->nama,
                'foto' => $name,
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

        Mobil::create([
            'user_id'       => request()->user()->id,
            'nama'          => $request->nama,
            'company'       => $request->company,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'tipe'          => $request->tipe,
            'transmisi'     => $request->transmisi,
            'overland'      => $request->overland,
            'ac'            => $request->ac,
            'jumlah_sit'    => $request->jumlah_sit,
            'harga'         => $request->harga,
            'review'        => $request->review,
            'rating'        => 0,
            'kota_search'   => $kota,
        ]);

        return redirect('mobil')->with('status', 'Postingan Mobil Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function show(Mobil $mobil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function edit(Mobil $mobil)
    {
        $data['title']      = 'Update Posting Mobil';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.mobil.updatemobil', compact('mobil'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mobil $mobil)
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
                            ->where('nama', '=', $mobil->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('mobil/' . $gambar->foto));
            }
            FileUpload::where('nama', $mobil->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('mobil', $name);

                FileUpload::create([
                    'nama' => $request->nama,
                    'foto' => $name,
                ]);
            }

            Mobil::where('id', $mobil->id)
                ->update([
                    'nama'          => $request->nama,
                    'company'       => $request->company,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'tipe'          => $request->tipe,
                    'transmisi'     => $request->transmisi,
                    'overland'      => $request->overland,
                    'ac'            => $request->ac,
                    'jumlah_sit'    => $request->jumlah_sit,
                    'harga'         => $request->harga,
                    'review'        => $request->review,
                    'kota_search'   => $kota,
                ]);
        } else {
            FileUpload::where('nama', $mobil->nama)
                ->update([
                    'nama'          => $request->nama
                ]);
            Mobil::where('id', $mobil->id)
                ->update([
                    'nama'          => $request->nama,
                    'company'       => $request->company,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'tipe'          => $request->tipe,
                    'transmisi'     => $request->transmisi,
                    'overland'      => $request->overland,
                    'ac'            => $request->ac,
                    'jumlah_sit'    => $request->jumlah_sit,
                    'harga'         => $request->harga,
                    'review'        => $request->review,
                    'kota_search'   => $kota,
                ]);
        }
        return redirect('mobil')->with('status', 'Postingan Mobil Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mobil $mobil)
    {
        $filegambar = DB::table('fileuploads')
        ->where('nama', '=', $mobil->nama)
            ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('mobil/' . $gambar->foto);
        }
        FileUpload::where('nama', $mobil->nama)->delete();
        Mobil::destroy($mobil->id);
        return redirect('mobil')->with('status', 'Postingan Mobil Berhasil Di Hapus');
    }
}