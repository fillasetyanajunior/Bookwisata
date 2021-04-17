<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }
        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1.25rem;
        }
        .my-3{
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        table {
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

    </style>
    <title>Konfirmasi Pembayaran</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <center>Checkout Complate</center> 
            </div>
            <div class="card-body">
                <h2>Terima Kasih Telah Memesan Layanan Kami </h2>
                <p>Berikut adalah detail pesanan anda lakukan pembayaran dan silahkan melakukan pembayaran sebelum time limite berakhir</p>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Kode Pemesanan</td>
                            <td>{{$kodes}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{$nama}}</td>
                        </tr>
                        <tr>
                            <td>Layanan Mitra</td>
                            <td>
                                @if ($paket == 1)
                                    Layanan 3 Bulan
                                @elseif($paket == 2)
                                    Layanan 6 Bulan
                                @elseif($paket == 3)
                                    Layanan 2 Tahun
                                @elseif($paket == 4)
                                    Layanan 1 Tahun
                                @else
                                    Layanan Trial 1 Bulan
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Total Pembayaran</td>
                            <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($harga)),3)))}}</td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>Waitting Payment</td>
                        </tr>
                        <tr>
                            <td>Batas Pembayaran</td>
                            <td>{{$waktupayment}}</td>
                        </tr>
                    </tbody>
                </table>
                <p>Setalah melakukan pembayaran segera kirim konfirmasi pembayaran di dashboard konfirmasi</p>
            </div>
            <div class="card-header">
                Metode Pembayaran
            </div>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="card my-3">
                        <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <a class="genric-btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            ATM BRI
                            </a>
                        </h2>
                        </div>
    
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Masukkan Kartu ATM Bank BRI.</li>
                                <li>- Pilih : Bahasa Indonesia.</li>
                                <li>- Masukan Nomor PIN Anda.</li>
                                <li>- Pilih : Transaksi Lainnya.</li>
                                <li>- Pilih : Pembayaran.</li>
                                <li>- Pilih : Lainnya.</li>
                                <li>- Masukan kode Bank Permata (013) + 8545580000530237</li>
                                <li>- Masukan Jumlah Saldo yang ingin di bayarkan dan Pilih OK </li>
                                <li>- Apabila Nomer Virtual Account Bener, informasi transaksi akan ditampilkan. Jumlah pembayaran harus sama dengan jumlah tagihan yang harus dibayar.Konfirmasi transaksi dengan menekan "Ya"</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card my-3 ">
                        <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <a class="genric-btn" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Mobile Bangking BRI
                            </a>
                        </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Buka Aplikasi BRI Mobile dan Buka Mobile Bangking BRI</li>
                                <li>- Pilih Menu Pembayaran > BRIVA</li>
                                <li>- Masukan kode Bank Permata (013) + 8545580000530237</li>
                                <li>- Masukan Jumlah Saldo yang ingin di bayarkan dan Pilih OK </li>
                                <li>- Masukan PIN Mobile Banking Anda dan Konfirmasi Transaksi Anda Melalui SMS</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <a class="genric-btn" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            ATM BNI
                            </a>
                        </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Masukkan Kartu Anda.</li>
                                <li>- Pilih Bahasa.</li>
                                <li>- Masukkan PIN ATM Anda.</li>
                                <li>- Pilih "Menu Lainnya".</li>
                                <li>- Pilih "Transfer".</li>
                                <li>- Pilih "Dari Rekening Tabungan".</li>
                                <li>- Pilih "Virtual Account Billing"</li>
                                <li>- Masukan kode Bank Permata (013) + 8545580000530237</li>
                                <li>- Masukan Jumlah Saldo yang ingin di bayarkan dan Pilih OK </li>
                                <li>- Konfirmasi Transaksi Anda</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <a class="genric-btn" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Mobile Banking BNI
                            </a>
                        </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Login ke Aplikasi BNI Mobile Banking</li>
                                <li>- Pilih menu "Transfer".</li>
                                <li>- Pilih menu "Virtual Account Billing"</li>
                                <li>- Pilih Tab "Input Baru" kemudian Masukan kode Bank Permata (013) + 8545580000530237</li>
                                <li>- Masukan Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi</li>
                                <li>- Konfirmasi transaksi dan masukkan Password Transaksi.</li>
                                <li>- Pembayaran Anda Telah Berhasil.</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <a class="genric-btn" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            BCA Mobile
                            </a>
                        </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Masukan ke Aplikasi Mobile m-BCA.</li>
                                <li>- Pilih : M-TRANSFER.</li>
                                <li>- Ketik : Nomor PIN ATM.</li>
                                <li>- Pilih : BCA VIRTUAL ACCOUNT.</li>
                                <li>- Masukan kode Bank Permata (013) + 8545580000530237</li>
                                <li>- Masukan Jumlah Saldo yang ingin di bayarkan dan Pilih OK </li>
                                <li>- Masukan PIN m-BCA Anda</li>
                                <li>- Ikutin intruksi untuk menyelesaikan transaksi</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                            <a class="genric-btn" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            ATM BCA
                            </a>
                        </h2>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Masukan kartu ATM dan PIN BCA Anda.</li>
                                <li>- Pilih : TRANSAKSI LAINNYA.</li>
                                <li>- Pilih : TRANSFER.</li>
                                <li>- Pilih : KE REKENING BCA VIRTUAL ACCOUNT.</li>
                                <li>- Masukan kode Bank Permata (013) + 8545580000530237</li>
                                <li>- Masukan Jumlah Saldo yang ingin di bayarkan dan Pilih OK </li>
                                <li>- Ikutin intruksi untuk menyelesaikan transaksi</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header" id="headingSeven">
                        <h2 class="mb-0">
                            <a class="genric-btn" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            ATM Mandiri
                            </a>
                        </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Masukan kartu ATM dan PIN BCA Anda.</li>
                                <li>- Pilih : Bayar/Beli.</li>
                                <li>- Pilih : Multipayment.</li>
                                <li>- Masukan kode Bank Permata (013) + 8545580000530237</li>
                                <li>- Masukan Jumlah Saldo yang ingin di bayarkan dan Pilih OK </li>
                                <li>- Ikutin intruksi untuk menyelesaikan transaksi</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>