<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Pusat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PusatController extends Controller
{
    public function index()
    {
        $data['pusat']      = Pusat::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title']      = 'Posting Pusat Oleh-Oleh';
        return view('admin.promosi.pusat.showpusat', $data);
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
            'gambar.*'    => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('pusat', $name);

            FileUpload::create([
                'nama'  => $request->nama,
                'foto'  => $name,
            ]);
        }

        $no = Pusat::orderBy("id_pusat", "DESC")->first();
        if ($no == null) {
            $id_pusat = 'PUS0001';
        } else {
            $nama = substr($no->id_pusat, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_pusat = 'PUS' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_pusat = 'PUS' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_pusat = 'PUS' . "0" . $tambah;
            } else {
                $id_pusat = 'PUS' . $tambah;
            }
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        Pusat::create([
            'user_id'       => request()->user()->id,
            'id_pusat'      => $id_pusat,
            'nama'          => $request->nama,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'alamat'        => $request->alamat,
            'review'        => $request->review,
            'harga'         => $request->harga,
            'rating'        => 0,
            'kota_search'   => $kota->name,
        ]);

        return redirect('pusat')->with('status', 'Postingan Pusat Oleh-Oleh Berhasil Di Upload');
    }
    public function edit(Pusat $pusat)
    {
        return response()->json([
            'pusat' => $pusat
        ]);
        // $data['title']      = 'Update Posting Pusat Oleh-Oleh';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.pusat.updatepusat', compact('pusat'), $data);
    }
    public function update(Request $request, Pusat $pusat)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = DB::table('fileuploads')
                            ->where('nama', '=', $pusat->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('pusat/' . $gambar->foto));
            }
            FileUpload::where('nama', $pusat->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('pusat', $name);

                FileUpload::create([
                    'nama' => $request->nama,
                    'foto' => $name,
                ]);
            }

            Pusat::where('id', $pusat->id)
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
            FileUpload::where('nama', $pusat->nama)
                ->update([
                    'nama'      => $request->nama
                ]);
            Pusat::where('id', $pusat->id)
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
        return redirect('pusat')->with('status', 'Postingan Pusat Oleh-Oleh Berhasil Di Update');
    }
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
