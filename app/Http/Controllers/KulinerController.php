<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Kabupaten;
use App\Models\Kuliner;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class KulinerController extends Controller
{
    public function index()
    {
        $data['kuliner']    = Kuliner::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title']      = 'Posting Kuliner';
        return view('admin.promosi.kuliner.showkuliner', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'provinsi'  => 'required',
            'kabupaten' => 'required',
            'alamat'    => 'required',
            'review'    => 'required',
            'harga'     => 'required',
            'gambar.*'  => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('kuliner', $name);

            FileUpload::create([
                'nama'  => $request->nama,
                'foto'  => $name,
            ]);
        }

        $no = Kuliner::orderBy("id_kuliner", "DESC")->first();
        if ($no == null) {
            $id_kuliner = 'KUL0001';
        } else {
            $nama = substr($no->id_kuliner, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_kuliner = 'KUL' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_kuliner = 'KUL' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_kuliner = 'KUL' . "0" . $tambah;
            } else {
                $id_kuliner = 'KUL' . $tambah;
            }
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        Kuliner::create([
            'user_id'       => request()->user()->id,
            'id_kuliner'    => $id_kuliner,
            'nama'          => $request->nama,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'alamat'        => $request->alamat,
            'review'        => $request->review,
            'harga'         => $request->harga,
            'rating'        => 0,
            'kota_search'   => $kota->name,
        ]);

        return redirect('kuliner')->with('status', 'Postingan Kuliner Berhasil Di Upload');
    }
    public function edit(Kuliner $kuliner)
    {
        return response()->json([
            'kuliner' => $kuliner
        ]);
        // $data['title']      = 'Update Posting Kuliner';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.kuliner.updatekuliner', compact('kuliner'), $data);
    }
    public function update(Request $request, Kuliner $kuliner)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = DB::table('fileuploads')
                            ->where('nama', '=', $kuliner->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('kuliner/' . $gambar->foto));
            }

            FileUpload::where('nama', $kuliner->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('kuliner', $name);

                FileUpload::create([
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
                'kota_search'   => $kota->name,
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
                'kota_search'   => $kota->name,
                ]);
        }
        return redirect('kuliner')->with('status', 'Postingan Kuliner Berhasil Di Update');
    }
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
