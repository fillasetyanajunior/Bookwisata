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
                <p>Berikut adalah detail pesanan anda. Silahkan melakukan pembayaran sebelum time limite berakhir.</p>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Kode Pemesanan</td>
                            <td>{{$qrkode}}</td>
                        </tr>
                        <tr>
                            <td>Nama Produk</td>
                            <td>{{$nama}}</td>
                        </tr>
                        <tr>
                            <td>Total Pembayaran</td>
                            <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($harga)),3)))}}</td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>Waitting Paymeny</td>
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
                            ATM Permata
                            </a>
                        </h2>
                        </div>
    
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Silahkan pilih menu Transaksi Lainnya. Setelah itu Klik menu Transfer lalu klik menu Rek NSB lain Permata.</li>
                                <li>- Masukan nomer rekening dengan nomer Virtual Account Anda (8545580000530237) dan pilih Benar.</li>
                                <li>- Masukan Jumlah nominal yang ingin anda transfer. Setalah itu Pilih Benar.</li>
                                <li>- Lalu pilih rekening Tunggu Sebentar hingga muncul konfirmasi pembayaran. Kemudian pilih Ya.</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card my-3 ">
                        <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <a class="genric-btn" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Internet Bangking Permata
                            </a>
                        </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Silahkan login internet bangking kemudian pilih Menu Pembayaran.</li>
                                <li>- Lalu pilih sub menu Pembayaran Tagihan dan klik Virtual Account</li>
                                <li>- Silahkan pilih rekening anda lalu masukan nomer rekening dengan nomer Virtual Account (8545580000530237) lalu klik Lanjut.</li>
                                <li>- Masukan Jumlah nominal yang ingin anda transfer. Kemudian klik Submit.</li>
                                <li>- Tunggu sebentar hingga anda memperoleh SMS notifikasi yang berisi sebuah Kode. Setelah itu masukkan Kode tersebut.</li>
                                <li>- Proses transfer internet banking telah selesai.</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <a class="genric-btn" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Mobile Banking Permata
                            </a>
                        </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Silahkan login mobile bangking yang dimiliki Permata Bank.</li>
                                <li>- Lalu klik Menu Pembayaran Tagihan dan pilih Menu Virtual Account.</li>
                                <li>- Kemudian pilih Tagihan Anda dan pilih Daftar Tgihan Baru.</li>
                                <li>- Masukan nomer rekening dengan nomer Virtual Account Anda (8545580000530237) sebagai Nomer Tagihan. Apabila selesai silahkan klik Konfirmasi.</li>
                                <li>- Masukan Nama Pengingat setelah itu klik Lanjut. Apabila selesai silahkan klik Konfirmasi.</li>
                                <li>- Kemudian masukan Jumlah nominal yang ingin anda transfer. Apabila selesai silahkan klik Konfirmasi.</li>
                                <li>- Masukan Response Code dan klik Konfirmasi apabilatelah selesai</li>
                                <li>- Proses transfer telah selesai</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <a class="genric-btn" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            ATM Bersama / Prima
                            </a>
                        </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li>- Masukan kartu ATM dan PIN anda pada mesin ATM.</li>
                                <li>- Pilih menu TRANSFER > TRANSFER KE BANK LAIN > TRANSFER ONLINE.</li>
                                <li>- Masukan kode Bank Permata : <b>013</b></li>
                                <li>- Masukan nomer Virtual Account Anda (8545580000530237) pada kolom nomer rekening tujuan.</li>
                                <li>- Kemudian masukan Jumlah nominal yang ingin anda transfer</li>
                                <li>- Ikuti instruksi untuk menyelesaikan transaksi.</li>
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