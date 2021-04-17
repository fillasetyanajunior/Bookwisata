<?php

namespace App\Mail;

use App\Models\TransaksiMitra;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KonfirmasiMitra extends Mailable
{
    use Queueable, SerializesModels;

    public $kodes,$harga,$paket,$nama,$waktupayment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($kode)
    {
        $data = TransaksiMitra::where('kode_transaksi',$kode)->first();
        $kodes = $data->kode_transaksi;
        $harga = $data->harga;
        $paket = $data->paket_mitra;
        $waktupayment = $data->waktu_payment;
        $nama = $data->nama;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.konfirmasi_mitra');
    }
}
