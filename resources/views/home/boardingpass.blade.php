<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Boardingpass</title>
</head>
<body>
    <center>
        <img src="{{url('assets/utama/img/logo/Logo.jpg')}}" width="300px">
    </center>
    <div class="container">
        <div class="d-flex justify-content-around">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th scope="row">Kepada Mr/Mr's {{$riwayat->nama}}</th>
                    </tr>
                    <tr>
                        <th scope="row"> <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($riwayat->qr_code)) !!} "></th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-around mt-1">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th scope="row">Status</th>
                        <td>: Confirmed</td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Company</th>
                        <td>: {{$riwayat->company}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Lengkap</th>
                        <td>: {{$riwayat->nama}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td>: {{$riwayat->email}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nomer Hp</th>
                        <td>: {{$riwayat->nomerhp}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Pesanan</th>
                        <td>: {{$riwayat->nama_pilihan}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah Pesanan</th>
                        <td>: {{$riwayat->jumlahpesanan}} Unit</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah Hari </th>
                        <td>: {{$riwayat->hari}} Hari</td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Pemakaian</th>
                        <td>: {{date('d-F-Y',strtotime($riwayat->date))}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Note/Programme Detail</th>
                        <td>: {{$riwayat->note}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-around">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Harga</th>
                        <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->harga)),3)))}}&nbsp;X&nbsp;{{$riwayat->hari}}&nbsp;Hari</td>
                    </tr>
                    <tr>
                        <th scope="row">Admin %</th>
                        <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->potongan)),3)))}}</td>
                    </tr>
                    @php
                        if ($riwayat->cost == null) {
                            $tambahan = ('-' . $riwayat->event);
                        } elseif ($riwayat->event == null) {
                            $tambahan = ('+' . $riwayat->cost);
                        } else{
                            $tambahan = 0;
                        }
                    @endphp
                    <tr>
                        <th scope="row">Cost/Diskon</th>
                        <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($tambahan)),3)))}}</td>
                    </tr>
                    @php
                        if ($riwayat->cost != null) {
                            $total = $riwayat->total - $tambahan;
                        } elseif ($riwayat->event != null) {
                            $total = $riwayat->total + $tambahan;
                        } else{
                            $total = $riwayat->total;
                        }
                    @endphp
                    <tr>
                        <th scope="row">Total</th>
                        <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($total)),3)))}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-around">
            <p style="margin:0 0 4px; font-weight:bold; color:#333333; font-size:14px; line-height:22px;">Bookwisata Indonesia</p>
        </div>
        <div class="d-flex justify-content-around">
            <p style="margin:0; color:#333333; font-size:11px; line-height:18px;">
                Jl. Wonosari Km.7 Brojogaten Gg. Sukun No. 36 Banguntapan Bantul Daerah Istimewa Yogyakarta,Indonesia. P: 24/7 customer support: +62 274 - 443165 | WA. +62 81 5791 3168 | E: info@bookwisata.com<br>
                Website: <a href="{{url('/')}}" style="color:#6d7e44; text-decoration:none; font-weight:bold;">www.Bookwisata.com</a>
            </p>
        </div>
    </div>
</body>
</html>
