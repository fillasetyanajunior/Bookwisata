<?php

namespace App\Http\Controllers;

use App\Models\Sepeda;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SepedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sepeda']   = Sepeda::where('user_id',request()->user()->id)->get();
        $data['title']  = 'Posting Rental Sepeda motor & Gowes';
        return view('admin.promosi.sepeda.showsepeda', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Rental Sepeda motor & Gowes';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.sepeda.createsepeda', compact('response'), $data);
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
            'nama'          => 'required',
            'company'       => 'required',
            'provinsi'      => 'required',
            'kabupaten'     => 'required',
            'tipe'          => 'required',
            'harga'         => 'required',
            'review'         => 'required',
            'gambar.*'      => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('sepeda', $name);

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

        Sepeda::create([
            'user_id'       => request()->user()->id,
            'nama'          => $request->nama,
            'company'       => $request->company,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'tipe'          => $request->tipe,
            'harga'         => $request->harga,
            'review'        => $request->review,
            'rating'        => 0,
            'kota_search'   => $kota,
        ]);

        return redirect('sepeda')->with('status', 'Postingan Rental Sepeda motor & Gowes Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sepeda  $sepeda
     * @return \Illuminate\Http\Response
     */
    public function show(Sepeda $sepeda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sepeda  $sepeda
     * @return \Illuminate\Http\Response
     */
    public function edit(Sepeda $sepeda)
    {
        $data['title']      = 'Update Posting Rental Sepeda motor & Gowes';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.sepeda.updatesepeda', compact('sepeda'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sepeda  $sepeda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sepeda $sepeda)
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
                            ->where('nama', '=', $sepeda->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('sepeda/' . $gambar->foto));
            }
            FileUpload::where('nama', $sepeda->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('sepeda', $name);

                FileUpload::create([
                    'nama' => $request->nama,
                    'foto' => $name,
                ]);
            }

            Sepeda::where('id', $sepeda->id)
                ->update([
                    'nama'          => $request->nama,
                    'company'       => $request->company,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'tipe'          => $request->tipe,
                    'harga'         => $request->harga,
                    'review'        => $request->review,
                    'kota_search'   => $kota,
                ]);
        } else {
            FileUpload::where('nama', $sepeda->nama)
                ->update([
                    'nama'          => $request->nama
                ]);
            Sepeda::where('id', $sepeda->id)
                ->update([
                    'nama'          => $request->nama,
                    'company'       => $request->company,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'tipe'          => $request->tipe,
                    'harga'         => $request->harga,
                    'review'        => $request->review,
                    'kota_search'   => $kota,
                ]);
        }
        return redirect('sepeda')->with('status', 'Postingan Rental Sepeda motor & Gowes Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sepeda  $sepeda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sepeda $sepeda)
    {
        $filegambar = DB::table('fileuploads')
        ->where('nama', '=', $sepeda->nama)
            ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('sepeda/' . $gambar->foto);
        }
        FileUpload::where('nama', $sepeda->nama)->delete();
        Sepeda::destroy($sepeda->id);
        return redirect('sepeda')->with('status', 'Postingan Rental Sepeda motor & Gowes Berhasil Di Hapus');
    }
}
