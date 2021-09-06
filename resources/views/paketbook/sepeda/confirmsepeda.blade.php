@extends('layouts.apputama')
@section('main')
<div class="container" style="text-align: center;">
    <div class="row">
        <div class="col-md-12 col-md-offset-1 my-5">
            <form action="" method="post" class="f1">
                <h3>Detail Sepeda</h3>
                <div class="f1-steps">
                    <div class="f1-progress">
                        <div class="f1-progress-line" data-now-value="25" data-number-of-steps="4" style="width: 25%;">
                        </div>
                    </div>
                    <div class="f1-step active">
                        <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                        <p>Detail Produk</p>
                    </div>
                    <div class="f1-step">
                        <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                        <p>Data Diri</p>
                    </div>
                    <div class="f1-step">
                        <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                        <p>Metode Pembayaran</p>
                    </div>
                    <div class="f1-step">
                        <div class="f1-step-icon"><i class="fa fa-address-book"></i></div>
                        <p>Detail Pesanan</p>
                    </div>
                </div>
                <!-- step 1 -->
                <fieldset>
                    <div class="mb-5">
                        <h4>Detail {{$sepeda->nama}}</h4>
                        <h5>{{$sepeda->company}}</h5>
                    </div>
                    @php
                    $foto = DB::table('sepeda')
                    ->join('fileuploads','fileuploads.nama','=','sepeda.nama')
                    ->select('fileuploads.foto')
                    ->where('fileuploads.nama','=',$sepeda->nama)
                    ->get();sepeda
                    @endphp
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @for ($i = 0; $i < count($foto); $i++) @if ($i==0) <div class="carousel-item active">
                                @else
                                <div class="carousel-item ">
                                    @endif
                                    <img src="{{asset('sepeda/' . $foto[$i]->foto)}}" class="d-block w-100">
                                </div>
                                @endfor
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="d-flex bd-highlight mt-4">
                        <div class="">
                            <h3>Bookwisata</h3>
                            @csrf
                            <input type="hidden" name="hidden" value="{{$sepeda->user_id}}">
                            <div class="form-group">
                                <input type="date" class="form-control mt-3" name="date">
                            </div>
                            <div>
                                <select class="form-select my-3" name="hari" data-harga="{{$sepeda->harga}}">
                                    <option value="">Pilih Berapa Hari</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div>
                                <select class="form-select my-3" name="pesanan" data-harga="{{$sepeda->harga}}">
                                    <option value="">Jumlah Pesanan</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="ml-auto ">
                            <h3>Harga Perhari</h3>
                            <h3>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($sepeda->harga)),3)))}}</h3>
                        </div>
                    </div>
                    <div class="f1-buttons mt-5 d-flex flex-row-reverse">
                        <button type="button" class="btn btn-primary btn-next">Selanjutnya <i
                                class="fa fa-arrow-right"></i></button>
                    </div>
                </fieldset>
                <!-- step 2 -->
                <fieldset>
                    <div class="row my-5">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Data Diri</h4>
                                    <div class="form-group">
                                        <label for="nama">Nama Panggilan</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="nama" name="name" aria-describedby="nama" value="{{old('name')}}">
                                        <small id="nama" class="form-text text-muted">Isi Nama pemesanan sesuai dengan
                                            KTP/SIM/PASPOR
                                            (tanpa ada gelar atau jabatan)</small>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="nomer">No.HP Anda</label>
                                            <input type="text"
                                                class="form-control @error('nomerhp') is-invalid @enderror" id="nomerhp"
                                                name="nomerhp" placeholder="08xxxxxxxxxx" value="{{old('nomerhp')}}">
                                            <small id="nomerhp" class="form-text text-muted">contoh : +628222233312 kode
                                                negara +62 dan
                                                nomer hp 08222233312</small>
                                        </div>
                                        <div class="col">
                                            <label for="email">Email Anda</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                name="email" placeholder="xxxx@gmail.com" value="{{old('email')}}">
                                            <small id="nama" class="form-text text-muted">contoh :
                                                bookingcart@gmail.com</small>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="namalengkap">Nama Lengkap</label>
                                        <input type="text"
                                            class="form-control @error('namalengkap') is-invalid @enderror"
                                            id="namalengkap" name="namalengkap" value="{{old('namalengkap')}}">
                                        <small id="namalengkap" class="form-text text-muted">Isi Nama pemesanan sesuai
                                            dengan
                                            KTP/SIM/PASPOR (tanpa ada gelar atau jabatan)</small>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="note">Note/ Program Detail</label>
                                        <textarea class="form-control" id="note" name="note" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="text-center ">
                                    @php
                                    $foto = DB::table('sepeda')
                                    ->join('fileuploads','fileuploads.nama','=','sepeda.nama')
                                    ->limit('1')
                                    ->where('fileuploads.nama','=',$sepeda->nama)
                                    ->get();
                                    @endphp
                                    @foreach ($foto as $foto)
                                    <img src="{{asset('sepeda/' . $foto->foto)}}" class="rounded mt-3" width="300px">
                                    @endforeach
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{$sepeda->nama}}</th>
                                                <th scope="col" colspan="2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="2">Durasi</td>
                                                <td id="durasi"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Tanggal</td>
                                                <td id="tanggal"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Jumlah Pemesanan</td>
                                                <td><span id="jumlahpesanandetail"></span> Unit</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr size="10px">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td colspan="2">Tipe sepeda</td>
                                                <td>
                                                    @if($sepeda->tipe == 51)
                                                        Gunung
                                                    @elseif($sepeda->tipe == 52)
                                                        Lipat
                                                    @else
                                                        Balap
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-5">
                        <div class="card-header bg-primary">Important Notice</div>
                        <div class="card-body">
                            <p class="card-text">Mohon dipastikan kembali jika pemesanan anda sudah benar</p>
                        </div>
                    </div>

                    <div class="card mt-5">
                        <h5 class="card-header bg-primary">Price Detail</h5>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">{{$sepeda->nama}}</th>
                                        <th scope="col" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                             @if($sepeda->tipe == 51)
                                                Gunung
                                            @elseif($sepeda->tipe == 52)
                                                Lipat
                                            @else
                                                Balap
                                            @endif
                                                /Hari
                                        </td>
                                        <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($sepeda->harga)),3)))}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Berapa Hari</td>
                                        <td id="jumlahhari"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Jumlah Pemesanan</td>
                                        <td><span id="jumlahpesanan"></span>  Unit</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Taxes and Other Fees (Including Sales Tax, Service Fee and Other
                                            Taxes)</td>
                                        <td id="potongan"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Total Price</td>
                                        <td id="totalprice"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="f1-buttons mt-5 d-flex flex-row-reverse">
                        <button type="button" class="btn btn-primary btn-next ml-2">Selanjutnya <i
                                class="fa fa-arrow-right"></i></button>
                        <button type="button" class="btn btn-warning btn-previous mr-2"><i class="fa fa-arrow-left"></i>
                            Sebelumnya</button>
                    </div>
                </fieldset>
                <!-- step 3 -->
                <fieldset>
                    <div class="my-5">
                        <p style="margin:0 30px 33px; text-align:center; text-transform:uppercase; font-size:24px; line-height:30px; font-weight:bold; color:#484a42;">
                            Metode Pembayaran
                        </p>
                        <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 10px;">
                            &nbsp;</p>
                        <p style="margin:0 30px 10px; text-align:center; text-transform:uppercase; font-size:18px; line-height:30px; font-weight:bold; color:#484a42;">
                            ATM Permata
                        </p>
                        <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 20px;">
                            &nbsp;</p>
                        <ul class="pembayaran">
                            <li>Silahkan pilih menu Transaksi Lainnya. Setelah itu Klik menu Transfer lalu klik menu Rek
                                NSB
                                lain Permata.</li>
                            <li>Masukan nomer rekening dengan nomer Virtual Account Anda (8545580000530237) dan pilih
                                Benar.
                            </li>
                            <li>Masukan Jumlah nominal yang ingin anda transfer. Setalah itu Pilih Benar.</li>
                            <li>Lalu pilih rekening Tunggu Sebentar hingga muncul konfirmasi pembayaran. Kemudian pilih
                                Ya.
                            </li>
                        </ul>
                        <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 10px;">
                            &nbsp;</p>
                        <p style="margin:0 30px 10px; text-align:center; text-transform:uppercase; font-size:18px; line-height:30px; font-weight:bold; color:#484a42;">
                            Internet Bangking Permata
                        </p>
                        <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 20px;">
                            &nbsp;</p>
                        <ul class="pembayaran">
                            <li>Silahkan login internet bangking kemudian pilih Menu Pembayaran.</li>
                            <li>Lalu pilih sub menu Pembayaran Tagihan dan klik Virtual Account</li>
                            <li>Silahkan pilih rekening anda lalu masukan nomer rekening dengan nomer Virtual Account
                                (8545580000530237) lalu klik Lanjut.</li>
                            <li>Masukan Jumlah nominal yang ingin anda transfer. Kemudian klik Submit.</li>
                            <li>Tunggu sebentar hingga anda memperoleh SMS notifikasi yang berisi sebuah Kode. Setelah
                                itu
                                masukkan Kode tersebut.</li>
                            <li>Proses transfer internet banking telah selesai.</li>
                        </ul>
                        <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 10px;">
                            &nbsp;</p>
                        <p style="margin:0 30px 10px; text-align:center; text-transform:uppercase; font-size:18px; line-height:30px; font-weight:bold; color:#484a42;">
                            sepedae Banking Permata
                        </p>
                        <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 20px;">
                            &nbsp;</p>
                        <ul class="pembayaran">
                            <li>Silahkan login sepedae bangking yang dimiliki Permata Bank.</li>
                            <li>Lalu klik Menu Pembayaran Tagihan dan pilih Menu Virtual Account.</li>
                            <li>Kemudian pilih Tagihan Anda dan pilih Daftar Tgihan Baru.</li>
                            <li>Masukan nomer rekening dengan nomer Virtual Account Anda (8545580000530237) sebagai
                                Nomer
                                Tagihan. Apabila selesai silahkan klik Konfirmasi.</li>
                            <li>Masukan Nama Pengingat setelah itu klik Lanjut. Apabila selesai silahkan klik
                                Konfirmasi.
                            </li>
                            <li>Kemudian masukan Jumlah nominal yang ingin anda transfer. Apabila selesai silahkan klik
                                Konfirmasi.</li>
                            <li>Masukan Response Code dan klik Konfirmasi apabilatelah selesai</li>
                            <li>Proses transfer telah selesai</li>
                        </ul>
                        <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 10px;">
                            &nbsp;</p>
                        <p style="margin:0 30px 10px; text-align:center; text-transform:uppercase; font-size:18px; line-height:30px; font-weight:bold; color:#484a42;">
                            ATM Bersama / Prima
                        </p>
                        <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 20px;">
                            &nbsp;</p>
                        <ul class="pembayaran">
                            <li>Masukan kartu ATM dan PIN anda pada mesin ATM.</li>
                            <li>Pilih menu TRANSFER > TRANSFER KE BANK LAIN > TRANSFER ONLINE.</li>
                            <li>Masukan kode Bank Permata : <b>013</b></li>
                            <li>Masukan nomer Virtual Account Anda (8545580000530237) pada kolom nomer rekening tujuan.
                            </li>
                            <li>Kemudian masukan Jumlah nominal yang ingin anda transfer</li>
                            <li>Ikuti instruksi untuk menyelesaikan transaksi.</li>
                        </ul>
                    </div>
                    <div class="f1-buttons mt-5 d-flex flex-row-reverse">
                        <button type="button" class="btn btn-primary btn-next ml-2">Selanjutnya <i
                                class="fa fa-arrow-right"></i></button>
                        <button type="button" class="btn btn-warning btn-previous mr-2"><i class="fa fa-arrow-left"></i>
                            Sebelumnya</button>
                    </div>
                </fieldset>
                <!-- step 4 -->
                <fieldset>
                    <div class="card my-5">
                        <div class="card-header text-white bg-info">
                            Booking Detail
                        </div>
                        <div class="card-body table-responsive" style="font-size: 18px;">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Pilihan</th>
                                        <th scope="col">Hari</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="namadetailpesanan"></td>
                                        <td>{{$sepeda->nama}}</td>
                                        <td id="haridetailpesanan"></td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th scope="col">Email</th>
                                        <th scope="col">Nomer Hp</th>
                                        <th scope="col">Tanggal Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="emaildetailpesanan"></td>
                                        <td id="nomerdetailpesanan"></td>
                                        <td id="tanggaldetailpesanan"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center mt-5">
                                Jangan Lupa Cek Booking Detail yang kami kirim lewat email Dan Tunjukan Kepada kami
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nilai Kami</h5>
                            <input type="hidden" name="jumlah_rating" value="{{$sepeda->rating}}">
                            <input type="hidden" name="nama" value="{{$sepeda->nama}}">
                            <input type="hidden" name="tipe" value="{{$sepeda->tipe}}">
                            <div class="form-inline mt-5">
                                <div class="col-md-6 ">
                                    <input type="text" class="form-control" name="rating" placeholder="1-4">
                                    <small class="form-text text-muted">Nilai Kami 1-4</small>
                                </div>
                                <div class="col-md-6 text-justify">
                                    <p>Terima Kasi Telah Mempercayai Kami Sebagai Partner Untuk Pemesanan Yang Kami
                                        Sediakan Untuk Anda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="f1-buttons mt-5 d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i>
                            Submit</button>
                        <button type="button" class="btn btn-warning btn-previous mr-2"><i class="fa fa-arrow-left"></i>
                            Sebelumnya</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection
