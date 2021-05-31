@extends('layouts.apputama')
@section('main')
@foreach ($lasted as $lasted)    
<div class="container col-xs-12 col-sm-6 col-md-8 my-5">
    <img src="{{url('assets/utama/img/logo/Logo.jpg')}}" class="card-img-top mb-5" alt="...">
    <div class="card mb-3">
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
                        <td>{{$lasted->nama}}</td>
                        <td>{{$lasted->nama_pilihan}}</td>
                        <td>{{date('l',strtotime($lasted->date))}}</td>
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
                        <td>{{$lasted->email}}</td>
                        <td>{{$lasted->nomerhp}}</td>
                        <td>{{date('d-F-Y',strtotime($lasted->date))}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-5">
                Jangan Lupa Cek Booking Detail yang kami kirim lewat email Dan Tunjukan Kepada kami
            </div>
        </div>
        <div class="card-footer text-white bg-info">
            <div class="text-center">
                {{$lasted->date}}
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nilai Kami</h5>
            <form action="/bordingkapal" method="post">
                @csrf
                @php
                    $kapal = DB::table('detail_riwayat')
                            ->join('kapal','kapal.nama','=','detail_riwayat.nama_pilihan')
                            ->limit('1')
                            ->where('kapal.nama','=',$lasted->nama_pilihan)
                            ->orderBy('detail_riwayat.date','DESC')
                            ->get();
                @endphp
                @foreach ($kapal as $kapal)
                <input type="hidden" name="jumlah_rating" value="{{$kapal->rating}}">
                <input type="hidden" name="nama" value="{{$kapal->nama}}">
                @endforeach
                <div class="form-inline mt-5">
                    <div class="col-md-6 ">
                        <input type="text" class="form-control" name="rating" placeholder="1-4">
                        <small class="form-text text-muted">Nilai Kami 1-4</small>
                    </div>
                    <div class="col-md-6 text-justify">
                        <p>Terima Kasi Telah Mempercayai Kami Sebagai Partner Untuk Pemesanan Yang Kami Sediakan Untuk Anda</p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primery my-3">Submit</button>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection