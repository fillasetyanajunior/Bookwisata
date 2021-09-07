<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\Bus;
use App\Models\Camp;
use App\Models\Destinasi;
use App\Models\DetailRiwayat;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\Kapal;
use App\Models\Kuliner;
use App\Models\Mobil;
use App\Models\Paket;
use App\Models\Pusat;
use App\Models\Riwayat;
use App\Models\Sepeda;
use App\Models\Tour;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function Checkout()
    {
        $data['cart'] = Cart::content();
        return view('cart.checkout',$data);
    }
    public function cart()
    {
        $data['cart'] = Cart::content();
        return view('cart.cart',$data);
    }
    public function CheckoutStore(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'nomerhp'       => ['required','max:12'],
            'email'         => 'required',
            'namalengkap'   => 'required',
            'hari'          => 'required',
            'date'          => 'required',
        ]);

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $qr = \Str::random($permitted_chars);

        for ($i=0; $i < count($request->qty); $i++) {

            $kode = \Str::limit($request->kode[$i], 3);
            if ($kode == 'BUS...') {
                $produk = Bus::where('id_bus',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                Bus::where('id_bus',$request->kode[$i])->update(['rating' => $total]);
            } elseif ($kode == 'CAM...') {
                $produk = Camp::where('id_camp',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Camp::where('id_camp',$request->kode[$i])->update(['rating' => $total]);
            } elseif ($kode == 'DES...') {
                $produk = Destinasi::where('id_destinasi',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Destinasi::where('id_destinasi',$request->kode[$i])->update(['rating' => $total]);
            } elseif ($kode == 'GUI...') {
                $produk = Guide::where('id_guide',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Guide::where('id_guide',$request->kode[$i])->update(['rating' => $total]);
            } elseif ($kode == 'Hot...') {
                $produk = Hotel::where('id_hotel',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Hotel::where('id_hotel',$request->kode[$i])->update(['rating' => $total]);
            } elseif ($kode == 'KAP...') {
                $produk = Kapal::where('id_kapal',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Kapal::where('id_kapal',$request->kode[$i])->update(['rating' => $total]);
            } elseif ($kode == 'KUL...') {
                $produk = Kuliner::where('id_kuliner',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Kuliner::where('id_kuliner',$request->kode[$i])->update(['rating' => $total]);
            } elseif ($kode == 'MOB...') {
                $produk = Mobil::where('id_mobil',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Mobil::where('id_mobil',$request->kode[$i])->update(['rating' => $total]);
            } elseif ($kode == 'PAK...') {
                $produk = Paket::where('id_paket',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Paket::where('id_paket',$request->kode[$i])->update(['rating' => $total]);
            } elseif ($kode == 'PUS...') {
                $produk = Pusat::where('id_pusat',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Pusat::where('id_pusat',$request->kode[$i])->update(['rating' => $total]);
            } elseif ($kode == 'SEP...') {
                $produk = Sepeda::where('id_sepeda',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Sepeda::where('id_sepeda',$request->kode[$i])->update(['rating' => $total]);
            } else{
                $produk = Tour::where('id_tour',$request->kode[$i])->first();
                $total = $produk->rating + $request->rating;
                $produk = Tour::where('id_tour',$request->kode[$i])->update(['rating' => $total]);
            }

            $jumlah = $request->price[$i] * $request->qty[$i];

            if ($produk->tipe == null || $produk->jumlah_sit == null) {
                $detail_riwayat = DetailRiwayat::create([
                    'nama'                  => $request->namalengkap,
                    'email'                 => $request->email,
                    'nomerhp'               => $request->nomerhp,
                    'nama_pilihan'          => $request->pilihan[$i],
                    'tipe'                  => '-',
                    'jumlah_sit'            => '-',
                    'harga'                 => $request->price[$i],
                    'jumlahpesanan'         => $request->qty[$i],
                    'durasi'                => null,
                    'potongan'              => 10,
                    'hari'                  => $request->hari,
                    'date'                  => $request->date,
                    'total'                 => $jumlah,
                ]);
            } else {
                $detail_riwayat = DetailRiwayat::create([
                    'nama'                  => $request->namalengkap,
                    'email'                 => $request->email,
                    'nomerhp'               => $request->nomerhp,
                    'nama_pilihan'          => $request->pilihan[$i],
                    'tipe'                  => $produk->tipe,
                    'jumlah_sit'            => $produk->jumlah_sit,
                    'harga'                 => $request->price[$i],
                    'jumlahpesanan'         => $request->qty[$i],
                    'durasi'                => null,
                    'potongan'              => 10,
                    'hari'                  => $request->hari,
                    'date'                  => $request->date,
                    'total'                 => $jumlah,
                ]);
            }
            if ($produk->company == null) {
                $riwayat = Riwayat::create([
                    'user_nama_customer'    => request()->user()->name,
                    'user_id_owner'         => $produk->user_id,
                    'company'               => '-',
                    'id_detail_riwayat'     => $detail_riwayat->id,
                    'is_active'             => 1,
                    'qr_code'               => $qr,
                    'note'                  => $request->note
                ]);
            }else{
                $riwayat = Riwayat::create([
                    'user_nama_customer'    => request()->user()->name,
                    'user_id_owner'         => $produk->user_id,
                    'company'               => $produk->company,
                    'id_detail_riwayat'     => $detail_riwayat->id,
                    'is_active'             => 1,
                    'qr_code'               => $qr,
                    'note'                  => $request->note
                ]);
            }

            if ($produk->user_id == $riwayat->user_id_owner) {
                event(new MyEvent($request->namalengkap . 'Memesan' . $request->pilihan[$i], $produk->user_id));
            }
        }
        Cart::destroy();
        return redirect('/');
    }
    public function storeCart(Request $request)
    {
        $request->validate([
            'quntity' => 'required'
        ]);
        if ($request->catagori_produk == 'bus') {
            $produk = Bus::where('id_bus',$request->id_produk)->first();
            $catagori = 'id_bus';
        }elseif ($request->catagori_produk == 'camp') {
            $produk = Camp::where('id_camp',$request->id_produk)->first();
            $catagori = 'id_camp';
        }elseif ($request->catagori_produk == 'destinasi') {
            $produk = Destinasi::where('id_destinasi',$request->id_produk)->first();
            $catagori = 'id_destinasi';
        }elseif ($request->catagori_produk == 'guide') {
            $produk = Guide::where('id_guide',$request->id_produk)->first();
            $catagori = 'id_guide';
        }elseif ($request->catagori_produk == 'hotel') {
            $produk = Hotel::where('id_hotel',$request->id_produk)->first();
            $catagori = 'id_hotel';
        }elseif ($request->catagori_produk == 'kapal') {
            $produk = Kapal::where('id_kapal',$request->id_produk)->first();
            $catagori = 'id_kapal';
        }elseif ($request->catagori_produk == 'kuliner') {
            $produk = Kuliner::where('id_kuliner',$request->id_produk)->first();
            $catagori = 'id_kuliner';
        }elseif ($request->catagori_produk == 'mobil') {
            $produk = Mobil::where('id_mobil',$request->id_produk)->first();
            $catagori = 'id_mobil';
        }elseif ($request->catagori_produk == 'paket') {
            $produk = Paket::where('id_paket',$request->id_produk)->first();
            $catagori = 'id_paket';
        }elseif ($request->catagori_produk == 'pusat') {
            $produk = Pusat::where('id_pusat',$request->id_produk)->first();
            $catagori = 'id_pusat';
        }elseif ($request->catagori_produk == 'sepeda') {
            $produk = Sepeda::where('id_sepeda',$request->id_produk)->first();
            $catagori = 'id_sepeda';
        }else {
            $produk = Tour::where('id_tour',$request->id_produk)->first();
            $catagori = 'id_tour';
        }
        Cart::add($produk->$catagori, $produk->nama, $request->quntity, $produk->harga);
        return redirect()->back();
    }
    public function deleteAll()
    {
        Cart::destroy();
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        Cart::remove($request->id);
        return redirect()->back();
    }
}
