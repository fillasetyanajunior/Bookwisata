<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['camp'] = Camp::where('user_id',request()->user()->id)->get();
        $data['title'] = 'Posting Perlengkapan Camping & Outdoor';
        return view('admin.promosi.camp.showcamp', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Perlengkapan Camping & Outdoor';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.camp.createcamp', compact('response'), $data);
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
            'review'        => 'required',
            'gambar.*'      => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('camp', $name);

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

        Camp::create([
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

        return redirect('camp')->with('status', 'Postingan Perlengkapan Camping & Outdoor Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function show(Camp $camp)
     {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function edit(Camp $camp)
    {
        $data['title']      = 'Update Posting Perlengkapan Camping & Outdoor';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.camp.updatecamp', compact('camp'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Camp $camp)
    {
        $validatedData  = $request->validate([
            'kabupaten' => 'required',
        ]);

        $url = Http::get('http://dev.farizdotid.com/api/daerahindonesia/kota', [
            'id_provinsi' => $request->provinsi
        ]);

        $kota = null;

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
                            ->where('nama', '=', $camp->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('camp/' . $gambar->foto));
            }
            FileUpload::where('nama', $camp->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('camp', $name);

                FileUpload::create([
                    'nama' => $request->nama,
                    'foto' => $name,
                ]);
            }

            Camp::where('id', $camp->id)
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
            FileUpload::where('nama', $camp->nama)
                ->update([
                    'nama'          => $request->nama
                ]);
            Camp::where('id', $camp->id)
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
        return redirect('camp')->with('status', 'Postingan Perlengkapan Camping & Outdoor Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Camp $camp)
    {
        $filegambar = DB::table('fileuploads')
        ->where('nama', '=', $camp->nama)
            ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('camp/' . $gambar->foto);
        }
        FileUpload::where('nama', $camp->nama)->delete();
        Camp::destroy($camp->id);
        return redirect('camp')->with('status', 'Postingan Perlengkapan Camping & Outdoor Berhasil Di Hapus');
    }
}
