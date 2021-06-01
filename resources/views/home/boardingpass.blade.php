<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Boardingpass</title>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-around mt-5">
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
        <div class="d-flex justify-content-around mt-5">
            <table class="table table-borderless">
                <tbody>
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
                        <td>: {{$riwayat->jumlahpesanan}} Pesanan</td>
                    </tr>
                    <tr>
                        <th scope="row">Jurasi</th>
                        <td>: {{$riwayat->durasi}} Jam</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah Hari </th>
                        <td>: {{$riwayat->hari}} Hari</td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Pemesanan</th>
                        <td>: {{date('d-F-Y',strtotime($riwayat->date))}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-around mt-5">
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
                        <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->harga)),3)))}}</td>
                    </tr>
                    <tr>
                        <th scope="row">PPN %</th>
                        <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->potongan)),3)))}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Total</th>
                        <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->total)),3)))}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>