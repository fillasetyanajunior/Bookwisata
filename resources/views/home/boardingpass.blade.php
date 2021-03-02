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
                        <th scope="row">Kepada Mr/Mr's {{$data->nama}}</th>
                    </tr>
                    <tr>
                        <th scope="row"> <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(substr(str_shuffle($permitted_chars), 0, 6))) !!} "></th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-around mt-5">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th scope="row">Nama Lengkap</th>
                        <td>: {{$data->nama}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td>: {{$data->email}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nomer Hp</th>
                        <td>: {{$data->nomerhp}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Pesanan</th>
                        <td>: {{$data->nama_pilihan}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah Pesanan</th>
                        <td>: {{$data->jumlahpesanan}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah Hari </th>
                        <td>: {{$data->hari}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Pemesanan</th>
                        <td>: {{$data->date}}</td>
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
                        <td>{{$data->harga}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Total</th>
                        <td>{{$data->total}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>