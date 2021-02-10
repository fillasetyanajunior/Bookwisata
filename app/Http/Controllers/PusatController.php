<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Pusat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PusatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pusat'] = Pusat::all();
        $data['title'] = 'Posting Pusat Oleh-Oleh';
        return view('admin.promosi.pusat.showpusat', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Pusat Oleh-Oleh';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.pusat.createpusat', compact('response'), $data);
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
            'gambar'    => ['required', 'image|mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('pusat', $name);

            FileUpload::create([
                'nama'  => $request->nama,
                'foto'  => $name,
            ]);
        }

        Pusat::create([
            'user_id'   => request()->user()->id,
            'nama'      => $request->nama,
            'provinsi'  => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'alamat'    => $request->alamat,
            'review'    => $request->review,
            'harga'     => $request->harga,
            'rating'    => 0,
        ]);

        return redirect('pusat')->with('status', 'Postingan Pusat Oleh-Oleh Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pusat  $pusat
     * @return \Illuminate\Http\Response
     */
    public function show(Pusat $pusat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pusat  $pusat
     * @return \Illuminate\Http\Response
     */
    public function edit(Pusat $pusat)
    {
        $data['title']      = 'Update Posting Pusat Oleh-Oleh';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.pusat.updatepusat', compact('pusat'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pusat  $pusat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pusat $pusat)
    {
        $validatedData  = $request->validate([
            'kabupaten' => 'required',
        ]);

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = DB::table('fileuploads')
            ->where('nama', '=', $pusat->nama)
                ->get();
            foreach ($filegambar as $gambar) {
                Storage::delete('pusat/' . $gambar->foto);
            }
            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('pusat', $name);

                FileUpload::where('nama', $pusat->nama)
                    ->update([
                        'nama' => $request->nama,
                        'foto' => $name,
                    ]);
            }

            Pusat::where('id', $pusat->id)
                ->update([
                    'nama'      => $request->nama,
                    'provinsi'  => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'alamat'    => $request->alamat,
                    'review'    => $request->review,
                    'harga'     => $request->harga,
                ]);
        } else {
            FileUpload::where('nama', $pusat->nama)
                ->update([
                    'nama'      => $request->nama
                ]);
            Pusat::where('id', $pusat->id)
                ->update([
                    'nama'      => $request->nama,
                    'provinsi'  => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'alamat'    => $request->alamat,
                    'review'    => $request->review,
                    'harga'     => $request->harga,
                ]);
        }
        return redirect('pusat')->with('status', 'Postingan Pusat Oleh-Oleh Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pusat  $pusat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pusat $pusat)
    {
        $filegambar = DB::table('fileuploads')
        ->where('nama', '=', $pusat->nama)
            ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('pusat/' . $gambar->foto);
        }
        FileUpload::where('nama', $pusat->nama)->delete();
        Pusat::destroy($pusat->id);
        return redirect('pusat')->with('status', 'Postingan Pust Oleh-Oleh Berhasil Di Hapus');
    }
}
