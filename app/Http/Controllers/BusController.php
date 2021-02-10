<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['bus']    = Bus::all();
        $data['title']  = 'Posting Bus';
        return view('admin.promosi.bus.showbus',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Posting Bus';
        $url            = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response       = $url['provinsi'];
        return view('admin.promosi.bus.createbus', compact('response'),$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData  =   $request->validate([
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
            'gambar'        => ['required','image','mimes:jpg,jpeg,png'],
        ]);

        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('bus', $name);

            FileUpload::create([
                'nama' => $request->nama,
                'foto' => $name,
            ]);
        }

        Bus::create([
            'user_id'       => request()->user()->id,
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
            'rating'        => 0,
        ]);
        
        return redirect('bus')->with('status','Postingan Bus Berhasil Di Upload');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        $data['title']      = 'Update Posting Bus';
        $url                = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $data['response']   = $url['provinsi'];
        return view('admin.promosi.bus.updatebus', compact('bus'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        $validatedData  = $request->validate([
            'kabupaten' => 'required',
        ]);

        if($request->hasfile('gambar'))
        {
            $request->validate([
                'gambar' => 'image|mimes:jpg,jpeg,png'
            ]);
            $filegambar = DB::table('fileuploads')
                            ->where('nama', '=', $bus->nama)
                            ->get(); 
            foreach($filegambar as $gambar)
            {
                Storage::delete('bus/'.$gambar->foto);
            }
            foreach ($request->file('gambar') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->storeAs('bus', $name);

                FileUpload::where('nama',$bus->nama)
                        ->update([
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
                ]);
        }
        return redirect('bus')->with('status', 'Postingan Bus Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
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
