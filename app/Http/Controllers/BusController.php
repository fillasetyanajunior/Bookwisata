<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\FileUpload;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BusController extends Controller
{
    public function index()
    {
        $data['bus']        = Bus::where('user_id',request()->user()->id)->get();
        $data['provinsi']   = Provinsi::all();
        $data['kabupaten']  = Kabupaten::all();
        $data['title']      = 'Posting Bus';
        return view('admin.promosi.bus.showbus',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'po'            => 'required',
            'provinsi'      => 'required',
            'kabupaten'     => 'required',
            'tipe'          => 'required',
            'transmisi'     => 'required',
            'ac'            => 'required',
            'overland'      => 'required',
            'jumlah_sit'    => 'required',
            'harga'         => 'required',
            'review'        => 'required',
            'gambar.*'      => ['required','image'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('bus', $name);

            FileUpload::create([
                'nama' => $request->nama,
                'foto' => $name,
            ]);
        }

        //Acak Kode Mitra
        $no = Bus::orderBy("id_bus", "DESC")->first();
        if ($no == null) {
            $id_bus = 'BUS0001';
        } else {
            $nama = substr($no->id_bus, 4, 4);
            $tambah = (int) $nama + 1;
            if (strlen($tambah) == 1) {
                $id_bus = 'BUS' . "000" . $tambah;
            } elseif (strlen($tambah) == 2) {
                $id_bus = 'BUS' . "00" . $tambah;
            } elseif (strlen($tambah) == 3) {
                $id_bus = 'BUS' . "0" . $tambah;
            } else {
                $id_bus = 'BUS' . $tambah;
            }
        }

        $kota = Kabupaten::where('kode',$request->kabupaten)->first();

        Bus::create([
            'user_id'       => request()->user()->id,
            'id_bus'        => $id_bus,
            'nama'          => $request->nama,
            'po'            => $request->po,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'tipe'          => $request->tipe,
            'transmisi'     => $request->transmisi,
            'overland'      => $request->overland,
            'ac'            => $request->ac,
            'jumlah_sit'    => $request->jumlah_sit,
            'harga'         => $request->harga,
            'review'        => $request->review,
            'rating'        => 0,
            'kota_search'   => $kota->name,
        ]);

        return redirect('bus')->with('status','Postingan Bus Berhasil Di Upload');

    }
    public function edit(Bus $bus)
    {
        return response()->json([
            'bus' => $bus
        ]);
        // $data['title']      = 'Update Posting Bus';
        // $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        // $data['response']   = $url['provinsi'];
        // return view('admin.promosi.bus.updatebus', compact('bus'), $data);
    }
    public function update(Request $request, Bus $bus)
    {
        $kota = Kabupaten::where('kode', $request->kabupaten)->first();

        if($request->hasfile('gambar'))
        {
            $request->validate([
                'gambar.*' => 'image|mimes:jpg,jpeg,png'
                ]);
                $filegambar = DB::table('fileuploads')
                                ->where('nama', '=', $bus->nama)
                                ->get();

            foreach($filegambar as $gambar)
            {
                Storage::delete(asset('bus/'. $gambar->foto));
            }

            FileUpload::where('nama', $bus->nama)->delete();

            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('bus', $name);

                FileUpload::create([
                        'nama' => $request->nama,
                        'foto' => $name,
                    ]);
            }

            Bus::where('id',$bus->id)
                ->update([
                'nama'          => $request->nama,
                'po'            => $request->po,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'tipe'          => $request->tipe,
                'transmisi'     => $request->transmisi,
                'overland'      => $request->overland,
                'ac'            => $request->ac,
                'jumlah_sit'    => $request->jumlah_sit,
                'harga'         => $request->harga,
                'review'        => $request->review,
                'kota_search'   => $kota->name,
            ]);
        }
        else
        {
            FileUpload::where('nama', $bus->nama)
            ->update([
                'nama' => $request->nama,
            ]);
            Bus::where('id', $bus->id)
                ->update([
                'nama'          => $request->nama,
                'po'            => $request->po,
                'provinsi'      => $request->provinsi,
                'kabupaten'     => $request->kabupaten,
                'tipe'          => $request->tipe,
                'transmisi'     => $request->transmisi,
                'overland'      => $request->overland,
                'ac'            => $request->ac,
                'jumlah_sit'    => $request->jumlah_sit,
                'harga'         => $request->harga,
                'review'        => $request->review,
                'kota_search'   => $kota->name,
                ]);
        }
        return redirect('bus')->with('status', 'Postingan Bus Berhasil Di Update');
    }
    public function destroy(Bus $bus)
    {
        $filegambar = DB::table('fileuploads')
                    ->where('nama','=', $bus->nama)
                    ->get();
        foreach ($filegambar as $gambar) {
            Storage::delete('bus/'.$gambar->foto);
        }
        FileUpload::where('nama',$bus->nama)->delete();
        Bus::destroy($bus->id);
        return redirect('bus')->with('status', 'Postingan Bus Berhasil Di Hapus');
    }
}
