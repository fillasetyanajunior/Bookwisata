<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Konfirmasi;

class KonfirmasiPembayaranMail extends Mailable
{
    use Queueable, SerializesModels;

    public $namaproduk,$kodetransaksi,$gambar;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $data = Konfirmasi::where('id',$id)->first();
        $this->namaproduk       = $data->nama;
        $this->kodetransaksi    = $data->qrcode;
        $this->gambar           = $data->filekonfirmasi;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.konfirmasipembayaran');
    }
}
