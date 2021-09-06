<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Guide;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    public function index()
    {
        $data['guide']      = Guide::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title']      = 'Posting Tour Guide';
        return view('admin.promosi.guide.showguide', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'provinsi'  => 'required',
            'kabupaten' => 'required',
            'review'    => 'required',
            'harga'     => 'required',
            'gambar.*'    => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('guide', $name);

            FileUpload::create([
                'nama' => $request->nama,
                'foto' => $name,
            ]);
        }

        //Acak Kode Mitra
        $no = Guide::orderBy("id_guide", "DESC")->first();
        if ($no == null) {
            $id_guide = 'GUI0001';
        } else {
            $nama = substr($no->id_guide, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_guide = 'GUI' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_guide = 'GUI' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_guide = 'GUI' . "0" . $tambah;
            } else {
                $id_guide = 'GUI' . $tambah;
            }
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        Guide::create([
            'user_id'       => request()->user()->id,
            'id_guide'      => $id_guide,
            'nama'          => $request->nama,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'review'        => $request->review,
            'harga'         => $request->harga,
            'rating'        => 0,
            'kota_search'   => $kota->name,
        ]);

        return redirect('guide')->with('status', 'Postingan Tour Guide Berhasil Di Upload');
    }
    public function edit(Guide $guide)
    {
        return response()->json([
            'guide' => $guide
        ]);
        // $data['title']      = 'Update Posting Tour Guide';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.guide.updateguide', compact('guide'), $data);
    }
    public function update(Request $request, Guide $guide)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = DB::table('fileuploads')
                            ->where('nama', '=', $guide->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('guide/' . $gambar->foto));
            }

            FileUpload::where('nama', $guide->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('guide', $name);

                FileUpload::create([
                    'nama' => $request->nama,
                    'foto' => $name,
                ]);
            }

            Guide::where('id', $guide->id)
                ->update([
                'nama'          => $request->nama,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'review'        => $request->review,
                'harga'         => $request->harga,
                'kota_search'   => $kota->name,
                ]);
        } else {
            FileUpload::where('nama', $guide->nama)
            ->update([
                'nama'      => $request->nama
            ]);
            Guide::where('id', $guide->id)
                ->update([
                'nama'          => $request->nama,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'review'        => $request->review,
                'harga'         => $request->harga,
                'kota_search'   => $kota->name,
                ]);
        }
        return redirect('guide')->with('status', 'Postingan Tour Guide Berhasil Di Update');
    }
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
