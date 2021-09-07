<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\FileUpload;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    public function index()
    {
        $data['tour'] = Tour::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title'] = 'Posting Perlengkapan Tour';
        return view('admin.promosi.tour.showtour', $data);
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

        $no = Tour::orderBy("id_tour", "DESC")->first();
        if ($no == null) {
            $id_tour = 'TOU0001';
        } else {
            $nama = substr($no->id_tour, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_tour = 'TOU' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_tour = 'TOU' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_tour = 'TOU' . "0" . $tambah;
            } else {
                $id_tour = 'TOU' . $tambah;
            }
        }

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('tour', $name);

            FileUpload::create([
                'nama' => $id_tour,
                'foto' => $name,
            ]);
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        //Foto Unit
        $files = $request->file('formFile');
        $nametour = time() . rand(1, 100) . '.' . $files->extension();
        $files->storeAs('tour', $nametour);

        Tour::create([
            'user_id'       => request()->user()->id,
            'id_tour'       => $id_tour,
            'nama'          => $request->nama,
            'company'       => $request->company,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'tipe'          => $request->tipe,
            'sale'          => $request->sale,
            'harga'         => $request->harga,
            'review'        => $request->review,
            'kota_search'   => $kota->name,
            'foto'          => $nametour,
        ]);

        return redirect('tour')->with('status', 'Postingan Perlengkapan Tour Berhasil Di Upload');
    }
    public function edit(Tour $tour)
    {
        return response()->json([
            'tour' => $tour
        ]);
        // $data['title']      = 'Update Posting Perlengkapan Tour';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.tour.updatetour', compact('tour'), $data);
    }
    public function update(Request $request, Tour $tour)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = FileUpload::where('nama', $tour->id_tour)->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('tour/' . $gambar->foto));
            }

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('tour', $name);

                FileUpload::where('nama', $tour->id_tour)
                            ->update([
                            'foto' => $name,
                        ]);
            }

            Tour::where('id', $tour->id)
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
        } else {
            //Foto Unit
            $files = $request->file('formFile');
            $nametour = time() . rand(1, 100) . '.' . $files->extension();
            $files->storeAs('tour', $nametour);

            Tour::where('id', $tour->id)
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
                'foto'          => $nametour,
            ]);

        }
        return redirect('tour')->with('status', 'Postingan Perlengkapan Tour Berhasil Di Update');
    }
    public function destroy(Tour $tour)
    {
        $filegambar = FileUpload::where('nama', $tour->id_tour)->get();

        foreach ($filegambar as $gambar) {
            Storage::delete('tour/' . $gambar->foto);
        }
        Storage::delete('tour/' . $tour->foto);
        FileUpload::where('nama', $tour->id_tour)->delete();
        Tour::destroy($tour->id);
        return redirect('tour')->with('status', 'Postingan Perlengkapan Tour Berhasil Di Hapus');
    }
}
