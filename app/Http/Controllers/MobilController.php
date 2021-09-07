<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Kabupaten;
use App\Models\Mobil;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index()
    {
        $data['mobil']      = Mobil::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title']      = 'Posting Mobil';
        return view('admin.promosi.mobil.showmobil', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'company'       => 'required',
            'provinsi'      => 'required',
            'kabupaten'     => 'required',
            'tipe'          => 'required',
            'transmisi'     => 'required',
            'ac'            => 'required',
            'overland'      => 'required',
            'jumlah_sit'    => 'required',
            'sale'          => 'required',
            'harga'         => 'required',
            'review'        => 'required',
            'formFile'      => ['required','image'],
            'gambar.*'      => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        $no = Mobil::orderBy("id_mobil", "DESC")->first();
        if ($no == null) {
            $id_mobil = 'MOB0001';
        } else {
            $nama = substr($no->id_mobil, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_mobil = 'MOB' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_mobil = 'MOB' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_mobil = 'MOB' . "0" . $tambah;
            } else {
                $id_mobil = 'MOB' . $tambah;
            }
        }

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('mobil', $name);

            FileUpload::create([
                'nama' => $id_mobil,
                'foto' => $name,
            ]);
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        //Foto Unit
        $files = $request->file('formFile');
        $namemobil = time() . rand(1, 100) . '.' . $files->extension();
        $files->storeAs('mobil', $namemobil);

        Mobil::create([
            'user_id'       => request()->user()->id,
            'id_mobil'      => $id_mobil,
            'nama'          => $request->nama,
            'company'       => $request->company,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'tipe'          => $request->tipe,
            'transmisi'     => $request->transmisi,
            'overland'      => $request->overland,
            'ac'            => $request->ac,
            'jumlah_sit'    => $request->jumlah_sit,
            'sale'          => $request->sale,
            'harga'         => $request->harga,
            'review'        => $request->review,
            'kota_search'   => $kota->name,
            'foto'          => $namemobil,
        ]);

        return redirect('mobil')->with('status', 'Postingan Mobil Berhasil Di Upload');
    }
    public function edit(Mobil $mobil)
    {
        return response()->json([
            'mobil' => $mobil
        ]);
        // $data['title']      = 'Update Posting Mobil';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.mobil.updatemobil', compact('mobil'), $data);
    }
    public function update(Request $request, Mobil $mobil)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = FileUpload::where('nama', $mobil->id_mobil)->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('mobil/' . $gambar->foto));
            }

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('mobil', $name);

                FileUpload::where('nama', $mobil->id_mobil)
                            ->update([
                            'foto' => $name,
                        ]);
            }

            Mobil::where('id', $mobil->id)
                ->update([
                    'nama'          => $request->nama,
                    'company'       => $request->company,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'tipe'          => $request->tipe,
                    'transmisi'     => $request->transmisi,
                    'overland'      => $request->overland,
                    'ac'            => $request->ac,
                    'jumlah_sit'    => $request->jumlah_sit,
                    'sale'          => $request->sale,
                    'harga'         => $request->harga,
                    'review'        => $request->review,
                    'kota_search'   => $kota->name,
                ]);
        } elseif ($request->hasfile('formFile')) {
            //Foto Unit
            $files = $request->file('formFile');
            $namemobil = time() . rand(1, 100) . '.' . $files->extension();
            $files->storeAs('mobil', $namemobil);

            Mobil::where('id', $mobil->id)
                ->update([
                'nama'          => $request->nama,
                'company'       => $request->company,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'tipe'          => $request->tipe,
                'transmisi'     => $request->transmisi,
                'overland'      => $request->overland,
                'ac'            => $request->ac,
                'jumlah_sit'    => $request->jumlah_sit,
                'sale'          => $request->sale,
                'harga'         => $request->harga,
                'review'        => $request->review,
                'rating'        => 0,
                'kota_search'   => $kota->name,
                'foto'          => $namemobil,
            ]);
        }
        return redirect('mobil')->with('status', 'Postingan Mobil Berhasil Di Update');
    }
    public function destroy(Mobil $mobil)
    {
        $filegambar = FileUpload::where('nama', $mobil->id_mobil)->get();

        foreach ($filegambar as $gambar) {
            Storage::delete('mobil/' . $gambar->foto);
        }
        Storage::delete('mobil/' . $mobil->foto);
        FileUpload::where('nama', $mobil->id_mobil)->delete();
        Mobil::destroy($mobil->id);
        return redirect('mobil')->with('status', 'Postingan Mobil Berhasil Di Hapus');
    }
}
