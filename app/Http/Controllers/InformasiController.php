<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    public function index()
    {
        $data['title']      = 'Informasi';
        $data['informasi']  = Informasi::paginate(10);
        return view('admin.informasi.showinformasi',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required',
            'informasi'         => 'required',
        ]);

        if ($request->hasfile('file')) {

            $request->validate([
                'file'  => 'required',
            ]);

            $file = $request->file;
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('informasi', $name);

            Informasi::create([
                'title'             => $request->title,
                'informasi'         => $request->informasi,
                'pilihinformasi'    => $request->pilihinformasi,
                'file'              => $name,
            ]);
        } else {
            Informasi::create([
                'title'             => $request->title,
                'informasi'         => $request->informasi,
                'pilihinformasi'    => $request->pilihinformasi,
            ]);
        }
        return redirect()->route('informasi')->with('status','Tambah Informasi Berhasil');
    }
    public function edit(Informasi $informasi)
    {
        return response()->json([
            'informasi' => $informasi
        ]);
    }
    public function update(Request $request, Informasi $informasi)
    {
        if ($request->hasfile('file')) {

            Storage::delete('informasi/'.$informasi->file);
            $file = $request->file;
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('informasi', $name);

            Informasi::where('id',$informasi->id)
                    ->update([
                    'title'             => $request->title,
                    'informasi'         => $request->informasi,
                    'pilihinformasi'    => $request->pilihinformasi,
                    'file'              => $request->file,
            ]);
        } else {
            Informasi::where('id',$informasi->id)
                    ->update([
                    'title'             => $request->title,
                    'informasi'         => $request->informasi,
                    'pilihinformasi'    => $request->pilihinformasi,
            ]);
        }

        return redirect()->route('informasi')->with('status', 'Update Informasi Berhasil');
    }
    public function destroy(Informasi $informasi)
    {
        Informasi::destroy($informasi->id);
        Storage::delete('informasi/'.$informasi->file);
        return redirect()->route('informasi')->with('status', 'Delete Informasi Berhasil');
    }
}
