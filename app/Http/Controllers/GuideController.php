<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['guide'] = Guide::all();
        $data['title'] = 'Posting Tour Guide';
        return view('admin.promosi.guide.showguide', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Tour Guide';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.guide.createguide', compact('response'), $data);
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
            'gambar'    => ['required', 'image|mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('guide', $name);

            FileUpload::create([
                'nama' => $request->nama,
                'foto' => $name,
            ]);
        }

        Guide::create([
            'user_id'   => request()->user()->id,
            'nama'      => $request->nama,
            'provinsi'  => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'review'    => $request->review,
            'harga'     => $request->harga,
            'rating'    => 0,
        ]);

        return redirect('guide')->with('status', 'Postingan Tour Guide Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function show(Guide $guide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function edit(Guide $guide)
    {
        $data['title']      = 'Update Posting Tour Guide';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.guide.updateguide', compact('guide'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guide $guide)
    {
        $validatedData  = $request->validate([
            'kabupaten' => 'required',
        ]);

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = DB::table('fileuploads')
            ->where('nama', '=', $guide->nama)
                ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete('guide/' . $gambar->foto);
            }

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('guide', $name);

                FileUpload::where('nama', $guide->nama)
                        ->update([
                        'nama' => $request->nama,
                        'foto' => $name,
                ]);
            }

            Guide::where('id', $guide->id)
                ->update([
                'nama'      => $request->nama,
                'provinsi'  => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'review'    => $request->review,
                'harga'     => $request->harga,
                ]);
        } else {
            FileUpload::where('nama', $guide->nama)
            ->update([
                'nama'      => $request->nama
            ]);
            Guide::where('id', $guide->id)
                ->update([
                'nama'      => $request->nama,
                'provinsi'  => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'review'    => $request->review,
                'harga'     => $request->harga,
                ]);
        }
        return redirect('guide')->with('status', 'Postingan Tour Guide Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guide  $guide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guide $guide)
    {
        $filegambar = DB::table('fileuploads')
        ->where('nama', '=', $guide->nama)
            ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('guide/' . $gambar->foto);
        }
        FileUpload::where('nama', $guide->nama)->delete();
        Guide::destroy($guide->id);
        return redirect('guide')->with('status', 'Postingan Tour Guide Berhasil Di Hapus');
    }
}
