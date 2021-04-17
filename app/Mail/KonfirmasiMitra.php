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
        $this->kodes = $data->kode_transaksi;
        $this->harga = $data->harga;
        $this->paket = $data->paket_mitra;
        $this->waktupayment = $data->waktu_payment;
        $this->nama = $data->nama;
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
