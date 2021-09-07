<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\FileUpload;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CampController extends Controller
{
    public function index()
    {
        $data['camp']       = Camp::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title']      = 'Promosi Alat Camping & Outdoor';
        return view('admin.promosi.camp.showcamp', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'company'       => 'required',
            'provinsi'      => 'required',
            'kabupaten'     => 'required',
            'tipe'          => 'required',
            'sale'          => 'required',
            'harga'         => 'required',
            'review'        => 'required',
            'formFile'      => ['required','image'],
            'gambar.*'      => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        $no = Camp::orderBy("id_camp", "DESC")->first();
        if ($no == null) {
            $id_camp = 'CAM0001';
        } else {
            $nama = substr($no->id_camp, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_camp = 'CAM' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_camp = 'CAM' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_camp = 'CAM' . "0" . $tambah;
            } else {
                $id_camp = 'CAM' . $tambah;
            }
        }

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('camp', $name);

            FileUpload::create([
                'nama' => $id_camp,
                'foto' => $name,
            ]);
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        //Foto Unit
        $files = $request->file('formFile');
        $namecamp = time() . rand(1, 100) . '.' . $files->extension();
        $files->storeAs('camp', $namecamp);

        Camp::create([
            'user_id'       => request()->user()->id,
            'id_camp'       => $id_camp,
            'nama'          => $request->nama,
            'company'       => $request->company,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'tipe'          => $request->tipe,
            'sale'          => $request->sale,
            'harga'         => $request->harga,
            'review'        => $request->review,
            'kota_search'   => $kota->name,
            'foto'          => $namecamp,
        ]);

        return redirect('camp')->with('status', 'Postingan Perlengkapan Camping & Outdoor Berhasil Di Upload');
    }
    public function edit(Camp $camp)
    {
        return response()->json([
            'camp' => $camp
        ]);
        // $data['title']      = 'Update Promosi Alat Camping & Outdoor';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.camp.updatecamp', compact('camp'), $data);
    }
    public function update(Request $request, Camp $camp)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = FileUpload::where('nama',$camp->id_camp)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('camp/' . $gambar->foto));
            }

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('camp', $name);

                FileUpload::where('nama', $camp->id_camp)
                        ->update([
                            'foto' => $name,
                        ]);
            }
            Camp::where('id', $camp->id)
                ->update([
                'nama'          => $request->nama,
                'company'       => $request->company,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'tipe'          => $request->tipe,
                'sale'          => $request->sale,
                'harga'         => $request->harga,
                'review'        => $request->review,
                'kota_search'   => $kota->name,
            ]);
        } elseif ($request->hasfile('formFile')) {

            //Foto Unit
            $files = $request->file('formFile');
            $namecamp = time() . rand(1, 100) . '.' . $files->extension();
            $files->storeAs('camp', $namecamp);

            Camp::where('id', $camp->id)
                ->update([
                'nama'          => $request->nama,
                'company'       => $request->company,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'tipe'          => $request->tipe,
                'sale'          => $request->sale,
                'harga'         => $request->harga,
                'review'        => $request->review,
                'rating'        => 0,
                'kota_search'   => $kota->name,
                'foto'          => $namecamp,
            ]);
        }

        return redirect('camp')->with('status', 'Postingan Perlengkapan Camping & Outdoor Berhasil Di Update');
    }
    public function destroy(Camp $camp)
    {
        $filegambar = FileUpload::where('nama', $camp->id_camp)->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('camp/' . $gambar->foto);
        }
        Storage::delete('camp/' . $camp->foto);
        FileUpload::where('nama', $camp->id_camp)->delete();
        Camp::destroy($camp->id);
        return redirect('camp')->with('status', 'Postingan Perlengkapan Camping & Outdoor Berhasil Di Hapus');
    }
}
