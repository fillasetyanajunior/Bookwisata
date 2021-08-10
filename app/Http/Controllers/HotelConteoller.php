<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Hotel;
use App\Models\Tipekamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HotelConteoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['hotel'] = Hotel::where('user_id',request()->user()->id)->get();
        $data['title'] = 'Posting Hotel';
        return view('admin.promosi.hotel.showhotel', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Hotel';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['tipe']   = Tipekamar::all();
        $response = $url['provinsi'];
        return view('admin.promosi.hotel.createhotel', compact('response'), $data);
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
            'nama'      => 'required',
            'provinsi'  => 'required',
            'kabupaten' => 'required',
            'tipe'      => 'required',
            'bad'       => 'required',
            'review'    => 'required',
            'harga'     => 'required',
            'gambar.*'    => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('hotel', $name);

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

        Hotel::create([
            'user_id'       => request()->user()->id,
            'nama'          => $request->nama,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'tipe'          => $request->tipe,
            'bad'           => $request->bad,
            'review'        => $request->review,
            'harga'         => $request->harga,
            'rating'        => 0,
            'kota_search'   => $kota,
        ]);

        return redirect('hotel')->with('status','Postingan Hotel Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $data['title']      = 'Update Posting Hotel';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['tipe']       = Tipekamar::all();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.hotel.updatehotel', compact('hotel'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
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
                            ->where('nama', '=', $hotel->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('hotel/' . $gambar->foto));
            }

            FileUpload::where('nama', $hotel->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('hotel', $name);

                FileUpload::create([
                    'nama' => $request->nama,
                    'foto' => $name,
                ]);
            }

            Hotel::where('id', $hotel->id)
                ->update([
                'nama'          => $request->nama,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'tipe'          => $request->tipe,
                'bad'           => $request->bad,
                'review'        => $request->review,
                'harga'         => $request->harga,
                'kota_search'   => $kota,
                ]);
        } else {
            FileUpload::where('nama', $hotel->nama)
                ->update([
                    'nama'  => $request->nama
                ]);
            Hotel::where('id', $hotel->id)
                ->update([
                'nama'          => $request->nama,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'tipe'          => $request->tipe,
                'bad'           => $request->bad,
                'review'        => $request->review,
                'harga'         => $request->harga,
                'kota_search'   => $kota,
                ]);
        }
        return redirect('hotel')->with('status', 'Postingan Hotel Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $filegambar = DB::table('fileuploads')
                        ->where('nama', '=', $hotel->nama)
                        ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('hotel/' . $gambar->foto);
        }
        FileUpload::where('nama', $hotel->nama)->delete();
        Hotel::destroy($hotel->id);
        return redirect('hotel')->with('status', 'Postingan Hotel Berhasil Di Hapus');
    }
}
