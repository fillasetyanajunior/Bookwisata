<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\TransaksiMitra;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementUserController extends Controller
{
    public function index()
    {
        $data['user']   = User::orderBy('name')->paginate(10);
        $data['title']  = 'Menagement User';
        return view('admin.managementuser.showmanagementuser',$data);
    }
    public function EditOfUser(User $user)
    {
        return response()->json([
            'user' => $user
        ]);
    }
    public function Update(Request $request,User $user)
    {
        if ($request->role == 2) {
            //Acak Kode Mitra
            $no = Mitra::orderBy("kode_mitra","DESC")->first();
            if($no == null)
            {
                $kode_mitra = 'MTR0001';
            }else
            {
                $nama = substr($no->kode_mitra, 4, 4);
                $tambah = (int) $nama + 1;
                if (strlen($tambah) == 1) {
                    $kode_mitra = 'MTR' . "000" . $tambah;
                } elseif (strlen($tambah) == 2) {
                    $kode_mitra = 'MTR' . "00" . $tambah;
                } elseif (strlen($tambah) == 3) {
                    $kode_mitra = 'MTR' . "0" . $tambah;
                } else {
                    $kode_mitra = 'MTR' . $tambah;
                }
            }

            $mitra = TransaksiMitra::where('nama',$user->name)->first();
            if ($mitra != null) {
                if ($mitra->paket_mitra == 1) {
                    $active_mitra = date('Y-m-d', strtotime('+3 month'));
                } elseif ($mitra->paket_mitra == 2) {
                    $active_mitra = date('Y-m-d', strtotime('+6 month'));
                } elseif ($mitra->paket_mitra == 3) {
                    $active_mitra = date('Y-m-d', strtotime('+2 year'));
                } elseif($mitra->paket_mitra == 4) {
                    $active_mitra = date('Y-m-d', strtotime('+1 year'));
                }else{
                    $active_mitra = date('Y-m-d', strtotime('+1 month'));
                }

                User::where('id',$user->id)
                    ->update([
                        'role'  => $request->role,
                    ]);
                Mitra::create([
                    'nama'          => $mitra->nama,
                    'email'         => $mitra->email,
                    'nomer'         => $mitra->nomer,
                    'alamat'        => $mitra->alamat,
                    'active_mitra'  => $active_mitra,
                    'kode_mitra'    => $kode_mitra,
                ]);
            } else {
                return redirect()->route('managementuser')->with('status','Update Data Gagal Karena Tidak Ada Transaksi Layanan Mitra');
            }

        } else {
            User::where('id', $user->id)
                ->update([
                    'role'  => $request->role,
                ]);
        }

        return redirect()->route('managementuser')->with('status','Update User Berhasil');
    }
}
