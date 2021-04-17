<?php

namespace App\Mail;

use App\Models\DetailRiwayat;
use App\Models\Riwayat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KonfirmasiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $qrkode;
    public $waktupayment;
    public $harga;
    public $nama;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $data = Riwayat::where('id',$id)->first();
        $detail = DetailRiwayat::where('id',$data->id_detail_riwayat)->first();
        $this->qrkode = $data->qr_code;
        $this->harga = $detail->total;
        $this->waktupayment = $data->waktu_payment;
        $this->nama = $detail->nama_pilihan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.konfirmasi');
        
    }
}
