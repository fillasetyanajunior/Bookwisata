<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use App\Models\Hotel;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Tipekamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HotelConteoller extends Controller
{
    public function index()
    {
        $data['hotel']      = Hotel::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['tipe']       = Tipekamar::all();
        $data['title']      = 'Posting Hotel';
        return view('admin.promosi.hotel.showhotel', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'provinsi'  => 'required',
            'kabupaten' => 'required',
            'tipe'      => 'required',
            'bad'       => 'required',
            'review'    => 'required',
            'sale'      => 'required',
            'harga'     => 'required',
            'formFile'  => ['required','image'],
            'gambar.*'  => ['required', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        $no = Hotel::orderBy("id_hotel", "DESC")->first();
        if ($no == null) {
            $id_hotel = 'HOT0001';
        } else {
            $nama = substr($no->id_hotel, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_hotel = 'HOT' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_hotel = 'HOT' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_hotel = 'HOT' . "0" . $tambah;
            } else {
                $id_hotel = 'HOT' . $tambah;
            }
        }

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('hotel', $name);

            FileUpload::create([
                'nama' => $id_hotel,
                'foto' => $name,
            ]);
        }

        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        //Foto Unit
        $files = $request->file('formFile');
        $namehotel = time() . rand(1, 100) . '.' . $files->extension();
        $files->storeAs('hotel', $namehotel);

        Hotel::create([
            'user_id'       => request()->user()->id,
            'id_hotel'      => $id_hotel,
            'nama'          => $request->nama,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'tipe'          => $request->tipe,
            'bad'           => $request->bad,
            'review'        => $request->review,
            'sale'          => $request->sale,
            'harga'         => $request->harga,
            'kota_search'   => $kota->name,
            'foto'          => $namehotel,
        ]);

        return redirect('hotel')->with('status','Postingan Hotel Berhasil Di Upload');
    }
    public function edit(Hotel $hotel)
    {
        return response()->json([
            'hotel' => $hotel
        ]);
        // $data['title']      = 'Update Posting Hotel';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['tipe']       = Tipekamar::all();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.hotel.updatehotel', compact('hotel'), $data);
    }
    public function update(Request $request, Hotel $hotel)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if ($request->hasfile('gambar')) {

            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
            ]);

            $filegambar = FileUpload::where('nama', $hotel->id_hotel)->get();

            foreach ($filegambar as $gambar) {
                Storage::delete(asset('hotel/' . $gambar->foto));
            }

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('hotel', $name);

                FileUpload::where('nama', $hotel->id_hotel)
                            ->update([
                            'foto' => $name,
                        ]);
            }
            Hotel::where('id', $hotel->id)
                ->update([
                'nama'          => $request->nama,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'tipe'          => $request->tipe,
                'bad'           => $request->bad,
                'review'        => $request->review,
                'sale'          => $request->sale,
                'harga'         => $request->harga,
                'kota_search'   => $kota->name,
            ]);
        } elseif ($request->hasfile('formFile')) {
            //Foto Unit
            $files = $request->file('formFile');
            $namehotel = time() . rand(1, 100) . '.' . $files->extension();
            $files->storeAs('hotel', $namehotel);

            Hotel::where('id', $hotel->id)
                ->update([
                'nama'          => $request->nama,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'tipe'          => $request->tipe,
                'bad'           => $request->bad,
                'review'        => $request->review,
                'sale'          => $request->sale,
                'harga'         => $request->harga,
                'rating'        => 0,
                'kota_search'   => $kota->name,
                'foto'          => $namehotel,
            ]);

        }

        return redirect('hotel')->with('status', 'Postingan Hotel Berhasil Di Update');
    }
    public function destroy(Hotel $hotel)
    {
        $filegambar = FileUpload::where('nama', $hotel->id_hotel)->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('hotel/' . $gambar->foto);
        }
        Storage::delete('hotel/' . $hotel->foto);
        FileUpload::where('nama', $hotel->id_hotel)->delete();
        Hotel::destroy($hotel->id);
        return redirect('hotel')->with('status', 'Postingan Hotel Berhasil Di Hapus');
    }
}
