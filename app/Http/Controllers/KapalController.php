<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class KapalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kapal'] = Kapal::where('user_id',request()->user()->id)->get();
        $data['title'] = 'Posting Kapal Pesiar';
        return view('admin.promosi.kapal.showkapal', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Kapal Pesiar';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.kapal.createkapal', compact('response'), $data);
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
            $file->storeAs('kapal', $name);

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

        Kapal::create([
            'user_id'       => request()->user()->id,
            'nama'          => $request->nama,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'review'        => $request->review,
            'harga'         => $request->harga,
            'rating'        => 0,
            'kota_search'   => $kota,
        ]);

        return redirect('kapal')->with('status', 'Postingan Kapal Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kapal  $kapal
     * @return \Illuminate\Http\Response
     */
    public function show(Kapal $kapal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kapal  $kapal
     * @return \Illuminate\Http\Response
     */
    public function edit(Kapal $kapal)
    {
        $data['title']      = 'Update Posting Kapal Pesiar';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.kapal.updatekapal', compact('kapal'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kapal  $kapal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kapal $kapal)
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
                            ->where('nama', '=', $kapal->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('kapal/' . $gambar->foto));
            }

            FileUpload::where('nama', $kapal->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('kapal', $name);

                FileUpload::create([
                    'nama' => $request->nama,
                    'foto' => $name,
                ]);
            }

            Kapal::where('id', $kapal->id)
                ->update([
                    'nama'          => $request->nama,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'review'        => $request->review,
                    'harga'         => $request->harga,
                    'kota_search'   => $kota,
                ]);
        } else {
            FileUpload::where('nama', $kapal->nama)
                ->update([
                    'nama'      => $request->nama
                ]);
            Kapal::where('id', $kapal->id)
                ->update([
                    'nama'          => $request->nama,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'review'        => $request->review,
                    'harga'         => $request->harga,
                    'kota_search'   => $kota,
                ]);
        }
        return redirect('kapal')->with('status', 'Postingan Kapal Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kapal  $kapal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kapal $kapal)
    {
        $filegambar = DB::table('fileuploads')
                        ->where('nama', '=', $kapal->nama)
                        ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('kapal/' . $gambar->foto);
        }
        FileUpload::where('nama', $kapal->nama)->delete();
        Kapal::destroy($kapal->id);
        return redirect('kapal')->with('status', 'Postingan Kapal Berhasil Di Hapus');
    }
}
