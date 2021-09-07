<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Kabupaten;
use App\Models\Kapal;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class KapalController extends Controller
{
    public function index()
    {
        $data['kapal'] = Kapal::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title'] = 'Posting Kapal Pesiar';
        return view('admin.promosi.kapal.showkapal', $data);
    }
    public function store(Request $request)
    {
       $request->validate([
            'nama'      => 'required',
            'provinsi'  => 'required',
            'kabupaten' => 'required',
            'review'    => 'required',
            'sale'      => 'required',
            'harga'     => 'required',
            'formFile'  => ['required','image'],
            'gambar.*'  => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);


        $no = Kapal::orderBy("id_kapal", "DESC")->first();
        if ($no == null) {
            $id_kapal = 'KAP0001';
        } else {
            $nama = substr($no->id_kapal, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_kapal = 'KAP' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_kapal = 'KAP' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_kapal = 'KAP' . "0" . $tambah;
            } else {
                $id_kapal = 'KAP' . $tambah;
            }
        }

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('kapal', $name);

            FileUpload::create([
                'nama' => $id_kapal,
                'foto' => $name,
            ]);
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        //Foto Unit
        $files = $request->file('formFile');
        $namekapal = time() . rand(1, 100) . '.' . $files->extension();
        $files->storeAs('kapal', $namekapal);

        Kapal::create([
            'user_id'       => request()->user()->id,
            'id_kapal'      => $id_kapal,
            'nama'          => $request->nama,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'review'        => $request->review,
            'sale'          => $request->sale,
            'harga'         => $request->harga,
            'kota_search'   => $kota->name,
            'foto'          => $namekapal,
        ]);

        return redirect('kapal')->with('status', 'Postingan Kapal Berhasil Di Upload');
    }
    public function edit(Kapal $kapal)
    {
        return response()->json([
            'kapal' => $kapal
        ]);
        // $data['title']      = 'Update Posting Kapal Pesiar';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.kapal.updatekapal', compact('kapal'), $data);
    }
    public function update(Request $request, Kapal $kapal)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = FileUpload::where('nama', $kapal->id_kapal)->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('kapal/' . $gambar->foto));
            }

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('kapal', $name);

                FileUpload::where('nama', $kapal->id_kapal)
                            ->update([
                            'foto' => $name,
                        ]);
            }
            Kapal::where('id', $kapal->id)
                ->update([
                'nama'          => $request->nama,
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
            $namekapal = time() . rand(1, 100) . '.' . $files->extension();
            $files->storeAs('kapal', $namekapal);

            Kapal::where('id', $kapal->id)
                ->update([
                'nama'          => $request->nama,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'review'        => $request->review,
                'sale'          => $request->sale,
                'harga'         => $request->harga,
                'rating'        => 0,
                'kota_search'   => $kota->name,
                'foto'          => $namekapal,
            ]);

        }

        return redirect('kapal')->with('status', 'Postingan Kapal Berhasil Di Update');
    }
    public function destroy(Kapal $kapal)
    {
        $filegambar = FileUpload::where('nama', $kapal->id_kapal)->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('kapal/' . $gambar->foto);
        }
        Storage::delete('kapal/' . $kapal->foto);
        FileUpload::where('nama', $kapal->id_kapal)->delete();
        Kapal::destroy($kapal->id);
        return redirect('kapal')->with('status', 'Postingan Kapal Berhasil Di Hapus');
    }
}
