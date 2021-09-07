<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Kabupaten;
use App\Models\Paket;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $data['paket']      = Paket::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title']      = 'Posting Paket Wisata';
        return view('admin.promosi.paket.showpaket', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'company'   => 'required',
            'provinsi'  => 'required',
            'kabupaten' => 'required',
            'review'    => 'required',
            'sale'      => 'required',
            'harga'     => 'required',
            'formFile'  => ['required','image'],
            'gambar.*'  => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        $no = Paket::orderBy("id_paket", "DESC")->first();
        if ($no == null) {
            $id_paket = 'PAK0001';
        } else {
            $nama = substr($no->id_paket, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_paket = 'PAK' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_paket = 'PAK' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_paket = 'PAK' . "0" . $tambah;
            } else {
                $id_paket = 'PAK' . $tambah;
            }
        }

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('paket', $name);

            FileUpload::create([
                'nama'  => $id_paket,
                'foto'  => $name,
            ]);
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        //Foto Unit
        $files = $request->file('formFile');
        $namepaket = time() . rand(1, 100) . '.' . $files->extension();
        $files->storeAs('paket', $namepaket);

        Paket::create([
            'user_id'       => request()->user()->id,
            'id_paket'      => $id_paket,
            'nama'          => $request->nama,
            'company'       => $request->company,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'review'        => $request->review,
            'sale'          => $request->sale,
            'harga'         => $request->harga,
            'kota_search'   => $kota->name,
            'foto'          => $namepaket,
        ]);

        return redirect('paket')->with('status', 'Postingan Paket Wisata Berhasil Di Upload');
    }
    public function edit(Paket $paket)
    {
        return response()->json([
            'paket' => $paket
        ]);
        // $data['title']      = 'Update Posting Paket Wisata';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.paket.updatepaket', compact('paket'), $data);
    }
    public function update(Request $request, Paket $paket)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = FileUpload::where('nama', $paket->id_paket)->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('paket/' . $gambar->foto));
            }

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('paket', $name);

                FileUpload::where('nama', $paket->id_paket)
                            ->update([
                            'foto' => $name,
                        ]);
            }

            Paket::where('id', $paket->id)
                ->update([
                    'nama'          => $request->nama,
                    'company'       => $request->company,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'review'        => $request->review,
                    'sale'          => $request->sale,
                    'harga'         => $request->harga,
                    'kota_search'   => $kota->name,
                ]);
        } elseif ($request->hasfile('formFile')) {
            //Foto Unit
            $files = $request->file('formFile');
            $namepaket = time() . rand(1, 100) . '.' . $files->extension();
            $files->storeAs('paket', $namepaket);

            Paket::where('id', $paket->id)
                ->update([
                'nama'          => $request->nama,
                'company'       => $request->company,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'review'        => $request->review,
                'sale'          => $request->sale,
                'harga'         => $request->harga,
                'rating'        => 0,
                'kota_search'   => $kota->name,
                'foto'          => $namepaket,
            ]);
        }
        return redirect('paket')->with('status', 'Postingan Paket Wisata Berhasil Di Update');
    }
    public function destroy(Paket $paket)
    {
        $filegambar = FileUpload::where('nama', $paket->id_paket)->get();

        foreach ($filegambar as $gambar) {
            Storage::delete('paket/' . $gambar->foto);
        }
        Storage::delete('paket/' . $paket->foto);
        FileUpload::where('nama', $paket->id_paket)->delete();
        Paket::destroy($paket->id);
        return redirect('paket')->with('status', 'Postingan Paket Wisata Berhasil Di Hapus');
    }
}
