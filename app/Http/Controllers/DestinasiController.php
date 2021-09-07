<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\FileUpload;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    public function index()
    {
        $data['destinasi']  = Destinasi::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title']      = 'Posting Destinasi';
        return view('admin.promosi.destinasi.showdestinasi', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'provinsi'  => 'required',
            'kabupaten' => 'required',
            'alamat'    => 'required',
            'review'    => 'required',
            'sale'      => 'required',
            'harga'     => 'required',
            'formFile'  => ['required','image'],
            'gambar.*'  => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        //Acak Kode Mitra
        $no = Destinasi::orderBy("id_destinasi", "DESC")->first();
        if ($no == null) {
            $id_destinasi = 'DES0001';
        } else {
            $nama = substr($no->id_destinasi, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_destinasi = 'DES' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_destinasi = 'DES' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_destinasi = 'DES' . "0" . $tambah;
            } else {
                $id_destinasi = 'DES' . $tambah;
            }
        }

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('destinasi', $name);

            FileUpload::create([
                'nama' => $id_destinasi,
                'foto' => $name,
            ]);
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        //Foto Unit
        $files = $request->file('formFile');
        $namedestinasi = time() . rand(1, 100) . '.' . $files->extension();
        $files->storeAs('destinasi', $namedestinasi);

        Destinasi::create([
            'user_id'       => request()->user()->id,
            'id_destinasi'  => $id_destinasi,
            'nama'          => $request->nama,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'alamat'        => $request->alamat,
            'review'        => $request->review,
            'sale'          => $request->sale,
            'harga'         => $request->harga,
            'kota_search'   => $kota->name,
            'foto'          => $namedestinasi,
        ]);

        return redirect('destinasi')->with('status', 'Postingan Destinasi Berhasil Di Upload');
    }
    public function edit(Destinasi $destinasi)
    {
        return response()->json([
            'destinasi' => $destinasi
        ]);
        // $data['title']      = 'Update Posting Destinasi';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.destinasi.updatedestinasi', compact('destinasi'), $data);
    }
    public function update(Request $request, Destinasi $destinasi)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {
            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);
            $filegambar = FileUpload::where('name', $destinasi->id_destinasi)->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('destinasi/' . $gambar->foto));
            }

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('destinasi', $name);

                FileUpload::where('name', $destinasi->id_destinasi)
                            ->update([
                            'foto' => $name,
                        ]);
            }
            Destinasi::where('id', $destinasi->id)
                ->update([
                'nama'          => $request->nama,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'alamat'        => $request->alamat,
                'review'        => $request->review,
                'sale'          => $request->sale,
                'harga'         => $request->harga,
                'kota_search'   => $kota->name,
            ]);
        } elseif ($request->hasfile('formFile')) {

            //Foto Unit
            $files = $request->file('formFile');
            $namedestinasi = time() . rand(1, 100) . '.' . $files->extension();
            $files->storeAs('destinasi', $namedestinasi);

            Destinasi::where('id', $destinasi->id)
                    ->update([
                    'nama'          => $request->nama,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'alamat'        => $request->alamat,
                    'review'        => $request->review,
                    'sale'          => $request->sale,
                    'harga'         => $request->harga,
                    'rating'        => 0,
                    'kota_search'   => $kota->name,
                    'foto'          => $namedestinasi,
                ]);

        }

        return redirect('destinasi')->with('status', 'Postingan Destinasi Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destinasi $destinasi)
    {
        $filegambar = FileUpload::where('name', $destinasi->id_destinasi)->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('destinasi/' . $gambar->foto);
        }
        Storage::delete('destinasi/' . $destinasi->foto);
        FileUpload::where('nama', $destinasi->id_destinasi)->delete();
        Destinasi::destroy($destinasi->id);
        return redirect('destinasi')->with('status', 'Postingan Destinasi Berhasil Di Hapus');
    }
}
