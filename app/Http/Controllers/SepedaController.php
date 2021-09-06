<?php

namespace App\Http\Controllers;

use App\Models\Sepeda;
use App\Models\FileUpload;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SepedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sepeda']     = Sepeda::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title']      = 'Posting Rental Sepeda motor & Gowes';
        return view('admin.promosi.sepeda.showsepeda', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'company'       => 'required',
            'provinsi'      => 'required',
            'kabupaten'     => 'required',
            'tipe'          => 'required',
            'harga'         => 'required',
            'review'         => 'required',
            'gambar.*'      => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('sepeda', $name);

            FileUpload::create([
                'nama' => $request->nama,
                'foto' => $name,
            ]);
        }

        $no = Sepeda::orderBy("id_sepeda", "DESC")->first();
        if ($no == null) {
            $id_sepeda = 'SEP0001';
        } else {
            $nama = substr($no->id_sepeda, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_sepeda = 'SEP' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_sepeda = 'SEP' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_sepeda = 'SEP' . "0" . $tambah;
            } else {
                $id_sepeda = 'SEP' . $tambah;
            }
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        Sepeda::create([
            'user_id'       => request()->user()->id,
            'id_sepeda'      => $id_sepeda,
            'nama'          => $request->nama,
            'company'       => $request->company,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'tipe'          => $request->tipe,
            'harga'         => $request->harga,
            'review'        => $request->review,
            'rating'        => 0,
            'kota_search'   => $kota->name,
        ]);

        return redirect('sepeda')->with('status', 'Postingan Rental Sepeda motor & Gowes Berhasil Di Upload');
    }
    public function edit(Sepeda $sepeda)
    {
        return response()->json([
            'sepeda' => $sepeda
        ]);
        // $data['title']      = 'Update Posting Rental Sepeda motor & Gowes';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.sepeda.updatesepeda', compact('sepeda'), $data);
    }
    public function update(Request $request, Sepeda $sepeda)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = DB::table('fileuploads')
                            ->where('nama', '=', $sepeda->nama)
                            ->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('sepeda/' . $gambar->foto));
            }
            FileUpload::where('nama', $sepeda->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('sepeda', $name);

                FileUpload::create([
                    'nama' => $request->nama,
                    'foto' => $name,
                ]);
            }

            Sepeda::where('id', $sepeda->id)
                ->update([
                    'nama'          => $request->nama,
                    'company'       => $request->company,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'tipe'          => $request->tipe,
                    'harga'         => $request->harga,
                    'review'        => $request->review,
                    'kota_search'   => $kota->name,
                ]);
        } else {
            FileUpload::where('nama', $sepeda->nama)
                ->update([
                    'nama'          => $request->nama
                ]);
            Sepeda::where('id', $sepeda->id)
                ->update([
                    'nama'          => $request->nama,
                    'company'       => $request->company,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'tipe'          => $request->tipe,
                    'harga'         => $request->harga,
                    'review'        => $request->review,
                    'kota_search'   => $kota->name,
                ]);
        }
        return redirect('sepeda')->with('status', 'Postingan Rental Sepeda motor & Gowes Berhasil Di Update');
    }
    public function destroy(Sepeda $sepeda)
    {
        $filegambar = DB::table('fileuploads')
        ->where('nama', '=', $sepeda->nama)
            ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('sepeda/' . $gambar->foto);
        }
        FileUpload::where('nama', $sepeda->nama)->delete();
        Sepeda::destroy($sepeda->id);
        return redirect('sepeda')->with('status', 'Postingan Rental Sepeda motor & Gowes Berhasil Di Hapus');
    }
}
