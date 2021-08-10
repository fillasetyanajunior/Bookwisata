<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tour'] = Tour::where('user_id',request()->user()->id)->get();
        $data['title'] = 'Posting Perlengkapan Tour';
        return view('admin.promosi.tour.showtour', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Perlengkapan Tour';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.tour.createtour', compact('response'), $data);
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
            $file->storeAs('tour', $name);

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

        Tour::create([
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

        return redirect('tour')->with('status', 'Postingan Perlengkapan Tour Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        $data['title']      = 'Update Posting Perlengkapan Tour';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.tour.updatetour', compact('tour'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        $request->validate([
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
                            ->where('nama', '=', $tour->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('tour/' . $gambar->foto));
            }
            FileUpload::where('nama', $tour->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('tour', $name);

                FileUpload::create([
                    'nama' => $request->nama,
                    'foto' => $name,
                ]);
            }

            Tour::where('id', $tour->id)
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
            FileUpload::where('nama', $tour->nama)
                ->update([
                    'nama'          => $request->nama
                ]);
            Tour::where('id', $tour->id)
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
        return redirect('tour')->with('status', 'Postingan Perlengkapan Tour Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        $filegambar = DB::table('fileuploads')
        ->where('nama', '=', $tour->nama)
            ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('tour/' . $gambar->foto);
        }
        FileUpload::where('nama', $tour->nama)->delete();
        Tour::destroy($tour->id);
        return redirect('tour')->with('status', 'Postingan Perlengkapan Tour Berhasil Di Hapus');
    }
}
