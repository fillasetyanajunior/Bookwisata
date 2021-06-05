@extends('layouts.apputama')

@section('main')
@foreach ($riwayat as $riwayat)
<div class="container col-xs-12 col-sm-6 col-md-8 mt-3 mb-3">
    <div class="row">
        <div class="col-lg-6">
            <form action="/bookchartcamp/{{$riwayat->id}} " method="post">
                @method('put')
                @csrf
            <h1>Data Pemesanan</h1>
            <div class="card mt-2">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Panggilan</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama" name="name" aria-describedby="nama" value="{{old('name')}}">
                        <small id="nama" class="form-text text-muted">Isi Nama pemesanan sesuai dengan KTP/SIM/PASPOR (tanpa ada gelar atau jabatan)</small>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="nomer">No.HP Anda</label>
                            <input type="text" class="form-control @error('nomerhp') is-invalid @enderror" id="nomerhp" name="nomerhp" placeholder="08xxxxxxxxxx" value="{{old('nomerhp')}}">
                            <small id="nomerhp" class="form-text text-muted">contoh : +628222233312 kode negara +62 dan nomer hp 08222233312</small>
                        </div>
                        <div class="col">
                            <label for="email">Email Anda</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="xxxx@gmail.com" value="{{old('email')}}">
                            <small id="nama" class="form-text text-muted">contoh : bookingcart@gmail.com</small>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label for="namalengkap">Nama Lengkap</label>
                        <input type="text" class="form-control @error('namalengkap') is-invalid @enderror" id="namalengkap" name="namalengkap" value="{{old('namalengkap')}}">
                        <small id="namalengkap" class="form-text text-muted">Isi Nama pemesanan sesuai dengan KTP/SIM/PASPOR (tanpa ada gelar atau jabatan)</small>
                    </div>
                    <div class="form-group mt-4">
                        <label for="note">Note/ Program Detail</label>
                        <textarea class="form-control" id="note" name="note" rows="4"></textarea>
                    </div>
                    
                </div>
            </div>
            <div class="card text-white  mb-3 mt-3">
                <div class="card-header bg-primary">Important Notice</div>
                <div class="card-body">
                    <p class="card-text">Mohon dipastikan kembali jika pemesanan anda sudah benar</p>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header bg-primary">Price Detail</h5>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                            <th scope="col">{{$riwayat->nama_pilihan}}</th>
                            <th scope="col" colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    @if($riwayat->tipe == 41)
                                        Bundling
                                    @else
                                        Non Bundling
                                    @endif
                                        /Hari
                                </td>
                                <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->harga)),3)))}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Berapa Hari</td>
                                <td>{{$riwayat->hari}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Taxes and Other Fees (Including Sales Tax, Service Fee and Other Taxes)</td>
                                <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->potongan)),3)))}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Total Price</td>
                                <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($riwayat->total)),3)))}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary mt-3 ">Submit</button>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="text-center ">
                    @php
                    $foto = DB::table('camp')
                                ->join('fileuploads','fileuploads.nama','=','camp.nama')
                                ->limit('1')
                                ->where('fileuploads.nama','=',$riwayat->nama_pilihan)
                                ->get();
                    @endphp
                    @foreach ($foto as $foto)
                    <img src="{{asset('camp/' . $foto->foto)}}"  class="rounded mt-3" width="300px">
                    @endforeach
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">{{$riwayat->nama_pilihan}}</th>
                            <th scope="col" colspan="2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="2">Durasi</td>
                            <td>{{$riwayat->hari}} hari</td>
                        </tr>
                        <tr>
                            <td colspan="2">Tanggal</td>
                            <td>{{date('d-F-Y',strtotime($riwayat->date))}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Jumlah Pemesanan</td>
                            <td>{{$riwayat->jumlahpesanan}} Unit</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr size="10px">
                    <table class="table table-borderless">
                        <tbody>
                        <tr>
                            <td colspan="2">Tipe</td>
                            <td>
                                @if($riwayat->tipe == 41)
                                    Bundling
                                @else
                                    Non Bundling
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
</div>
@endforeach
@endsection