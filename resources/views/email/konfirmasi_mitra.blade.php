<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color:#f0f2ea; margin:0; padding:0; color:#333333;">

<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td style="padding:40px 0;">
                <!-- begin main block -->
                <table cellpadding="0" cellspacing="0" width="608" border="0" align="center">
                    <tbody>
                        <tr>
                            <td>
                                <a href="{{url('/')}}" style="display:block; width:407px; height:100px; margin:0 auto 30px;">
                                    <img src="{{url('assets/utama/img/logo/Logo.jpg')}}" width="407" height="100" alt="Pixelbuddha" style="display:block; border:0; margin:0;">
                                </a>
                                {{-- <p style="margin:0 0 36px; text-align:center; font-size:14px; line-height:20px; text-transform:uppercase; color:#626658;">
                                    what is the most fascinating thing about summer?
                                </p> --}}
                                <!-- begin wrapper -->
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="8" height="4" colspan="2" style="background:url({{url("assets/email/shadow-top-left.png")}}) no-repeat 100% 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td height="4" style="background:url({{url("assets//email/shadow-top-center.png")}}) repeat-x 0 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="8" height="4" colspan="2" style="background:url({{url("assets//email/shadow-top-right.png")}}) no-repeat 0 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                        
                                        <tr>
                                            <td width="4" height="4" style="background:url({{url("assets//email/shadow-left-top.png")}}) no-repeat 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td colspan="3" rowspan="3" bgcolor="#f0f2ea" style="padding:0 0 30px;">
                                                <!-- begin content -->
                                                <img src="{{url('assets/utama/testmonial/bg1.jpg')}}" width="600" height="400" alt="summer‘s coming trimm your sheeps" style="display:block; border:0; margin:0 0 44px; background:#eeeeee;">
                                                <p style="margin:0 30px 33px; text-align:center; text-transform:uppercase; font-size:24px; line-height:30px; font-weight:bold; color:#484a42;">
                                                    Checkout Complate
                                                </p>
                                                <p style="margin:0 30px 33px; text-align:left; text-transform:capitalize; font-size:20px; line-height:30px; font-weight:bold; color:#484a42;">
                                                    Terima Kasih Telah Memesan Layanan Kami 
                                                </p>
                                                <p style="margin:0 30px 25px; text-align:left; text-transform:capitalize; font-size:14px; line-height:30px; color:#484a42;">
                                                    Berikut adalah detail pesanan anda. Silahkan melakukan pembayaran sebelum time limite berakhir.
                                                </p>
                                                <p style="margin:0 30px 20px; text-align:left; text-transform:capitalize; font-size:14px; color:#484a42;">
                                                    Bank Transfer :
                                                </p>
                                                <p style="margin:0 30px 10px; text-align:left; text-transform:capitalize; font-size:14px; color:#484a42;">
                                                    Bank Permata (Virtual Account)
                                                </p>
                                                <p style="margin:0 30px 10px; text-align:left; text-transform:capitalize; font-size:14px; color:#484a42;">
                                                    A/C  8545580000530237
                                                </p>
                                                <p style="margin:0 30px 10px; text-align:left; text-transform:capitalize; font-size:14px; color:#484a42;">
                                                     Bookwisata Indonesia
                                                </p>
                                                <br>
                                                <table style="margin:0 30px 33px; width: 90%;margin-bottom: 1rem;color: #212529; border-collapse: collapse;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333; ">Kode Pemesanan</p>
                                                            </td>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333;">{{$qrkode}}</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333; ">Nama</p>
                                                            </td>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333;">{{$nama}}</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333; ">Layanan Mitra</p>
                                                            </td>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333;">
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
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333; ">Total Pembayaran</p>
                                                            </td>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333;">{{'Rp. '.strrev(implode('.',str_split(strrev(strval($harga)),3)))}}</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333; ">Status Pembayaran</p>
                                                            </td>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333;">Waiting Payment</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333; ">Batas Pembayaran</p>
                                                            </td>
                                                            <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                                                <p style="font-size: 16px; color:#333333;">{{$waktupayment}}</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p style="margin:0 30px 33px; text-align:left; text-transform:capitalize; font-size:14px; line-height:30px; color:#484a42;">
                                                    Setalah melakukan pembayaran segera kirim konfirmasi pembayaran di dashboard konfirmasi.
                                                </p>
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 29px;">&nbsp;</p>
                                                <p style="margin:0 30px 33px; text-align:center; text-transform:uppercase; font-size:24px; line-height:30px; font-weight:bold; color:#484a42;">
                                                    Metode Pembayaran
                                                </p>
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 10px;">&nbsp;</p>
                                                <p style="margin:0 30px 10px; text-align:center; text-transform:uppercase; font-size:18px; line-height:30px; font-weight:bold; color:#484a42;">
                                                    ATM Permata
                                                </p>
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 20px;">&nbsp;</p>
                                                <ul style="font-family: 'Times New Roman', Times, serif; font-size: 18px">
                                                    <li>Silahkan pilih menu Transaksi Lainnya. Setelah itu Klik menu Transfer lalu klik menu Rek NSB lain Permata.</li>
                                                    <li>Masukan nomer rekening dengan nomer Virtual Account Bookwisata Indonesia (8545580000530237) dan pilih Benar.</li>
                                                    <li>Masukan Jumlah nominal yang ingin anda transfer. Setalah itu Pilih Benar.</li>
                                                    <li>Lalu pilih rekening Tunggu Sebentar hingga muncul konfirmasi pembayaran. Kemudian pilih Ya.</li>
                                                </ul>
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 10px;">&nbsp;</p>
                                                <p style="margin:0 30px 10px; text-align:center; text-transform:uppercase; font-size:18px; line-height:30px; font-weight:bold; color:#484a42;">
                                                    Internet Bangking Permata
                                                </p>
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 20px;">&nbsp;</p>
                                                <ul style="font-family: 'Times New Roman', Times, serif; font-size: 18px">
                                                    <li>Silahkan login internet bangking kemudian pilih Menu Pembayaran.</li>
                                                    <li>Lalu pilih sub menu Pembayaran Tagihan dan klik Virtual Account</li>
                                                    <li>Silahkan pilih rekening anda lalu masukan nomer rekening dengan nomer Virtual Account Bookwisata Indonesia (8545580000530237) lalu klik Lanjut.</li>
                                                    <li>Masukan Jumlah nominal yang ingin anda transfer. Kemudian klik Submit.</li>
                                                    <li>Tunggu sebentar hingga anda memperoleh SMS notifikasi yang berisi sebuah Kode. Setelah itu masukkan Kode tersebut.</li>
                                                    <li>Proses transfer internet banking telah selesai.</li>
                                                </ul>
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 10px;">&nbsp;</p>
                                                <p style="margin:0 30px 10px; text-align:center; text-transform:uppercase; font-size:18px; line-height:30px; font-weight:bold; color:#484a42;">
                                                    Mobile Banking Permata
                                                </p>
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 20px;">&nbsp;</p>
                                                <ul style="font-family: 'Times New Roman', Times, serif; font-size: 18px">
                                                    <li>Silahkan login mobile bangking yang dimiliki Permata Bank.</li>
                                                    <li>Lalu klik Menu Pembayaran Tagihan dan pilih Menu Virtual Account.</li>
                                                    <li>Kemudian pilih Tagihan Anda dan pilih Daftar Tgihan Baru.</li>
                                                    <li>Masukan nomer rekening dengan nomer Virtual Account Bookwisata Indonesia (8545580000530237) sebagai Nomer Tagihan. Apabila selesai silahkan klik Konfirmasi.</li>
                                                    <li>Masukan Nama Pengingat setelah itu klik Lanjut. Apabila selesai silahkan klik Konfirmasi.</li>
                                                    <li>Kemudian masukan Jumlah nominal yang ingin anda transfer. Apabila selesai silahkan klik Konfirmasi.</li>
                                                    <li>Masukan Response Code dan klik Konfirmasi apabilatelah selesai</li>
                                                    <li>Proses transfer telah selesai</li>
                                                </ul>
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 10px;">&nbsp;</p>
                                                <p style="margin:0 30px 10px; text-align:center; text-transform:uppercase; font-size:18px; line-height:30px; font-weight:bold; color:#484a42;">
                                                    ATM Bersama / Prima
                                                </p>
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 20px;">&nbsp;</p>
                                                <ul style="font-family: 'Times New Roman', Times, serif; font-size: 18px">
                                                    <li>Masukan kartu ATM dan PIN anda pada mesin ATM.</li>
                                                    <li>Pilih menu TRANSFER > TRANSFER KE BANK LAIN > TRANSFER ONLINE.</li>
                                                    <li>Masukan kode Bank Permata : <b>013</b></li>
                                                    <li>Masukan nomer Virtual Account Bookwisata Indonesia (8545580000530237) pada kolom nomer rekening tujuan.</li>
                                                    <li>Kemudian masukan Jumlah nominal yang ingin anda transfer</li>
                                                    <li>Ikuti instruksi untuk menyelesaikan transaksi.</li>
                                                </ul>
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 20px;">&nbsp;</p>
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tbody>
                                                        <tr valign="top">
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td>
                                                                <p style="margin:0 0 4px; font-weight:bold; color:#333333; font-size:14px; line-height:22px;">Bookwisata Indonesia</p>
                                                                <p style="margin:0; color:#333333; font-size:11px; line-height:18px;">
                                                                    Jl. Wonosari Km.7 Brojogaten Gg. Sukun No. 36 Banguntapan Bantul Daerah Istimewa Yogyakarta,Indonesia. P: 24/7 <br>
                                                                    Help &amp; customer support: +62 274 - 443165 | WA. +62 81 5791 3168 | E: info@bookwisata.com<br>
                                                                    Website: <a href="{{url('/')}}" style="color:#6d7e44; text-decoration:none; font-weight:bold;">www.Bookwisata.com</a>
                                                                </p>
                                                            </td>
                                                            <td width="150"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td width="120">
                                                                <a href="https://www.facebook.com/pixelbuddha" style="float:left; width:24px; height:24px; margin:6px 8px 10px 0;">
                                                                    <img src="{{url("assets/email/facebook.png")}}" width="24" height="24" alt="facebook" style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <a href="https://twitter.com/PixelBuddha" style="float:left; width:24px; height:24px; margin:6px 8px 10px 0;">
                                                                    <img src="{{url("assets/email/twitter.png")}}" width="24" height="24" alt="twitter" style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <a href="http://blog.pixelbuddha.net/" style="float:left; width:24px; height:24px; margin:6px 8px 10px 0;;">
                                                                    <img src="{{url("assets/email/tumblr.png")}}" width="24" height="24" alt="tumblr" style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <a href="{{url('/')}}rss" style="float:left; width:24px; height:24px; margin:6px 0 10px 0;">
                                                                    <img src="{{url("assets/email/rss.png")}}" width="24" height="24" alt="rss" style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <p style="margin:0; font-weight:bold; clear:both; font-size:12px; line-height:22px;">
                                                                    <a href="{{url('/')}}" style="color:#6d7e44; text-decoration:none;">Visit website</a><br>
                                                                    <a href="{{url('/')}}" style="color:#6d7e44; text-decoration:none;">Mobile version</a>
                                                                </p>
                                                            </td>
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end content --> 
                                            </td>
                                            <td width="4" height="4" style="background:url({{url("assets/email/shadow-right-top.png")}}) no-repeat 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                        
                                        <tr>
                                            <td width="4" style="background:url({{url("assets/email/shadow-left-center.png")}}) repeat-y 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" style="background:url({{url("assets/email/shadow-right-center.png")}}) repeat-y 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                        
                                        <tr> 
                                            <td width="4" height="4" style="background:url({{url("assets/email/shadow-left-bottom.png")}}) repeat-y 100% 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url({{url("assets/email/shadow-right-bottom.png")}}) repeat-y 0 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                 
                                        <tr>
                                            <td width="4" height="4" style="background:url({{url("assets/email/shadow-bottom-corner-left.png")}}) no-repeat 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url({{url("assets/email/shadow-bottom-left.png")}}) no-repeat 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td height="4" style="background:url({{url("assets/email/shadow-bottom-center.png")}}) repeat-x 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url({{url("assets/email/shadow-bottom-right.png")}}) no-repeat 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url({{url("assets/email/shadow-bottom-corner-right.png")}}) no-repeat 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- end wrapper-->
                                <p style="margin:0; padding:34px 0 0; text-align:center; font-size:11px; line-height:13px; color:#333333;">
                                    Don‘t want to recieve further emails? You can unsibscribe <a href="{{url('/')}}" style="color:#333333; text-decoration:underline;">here</a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- end main block -->
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>
