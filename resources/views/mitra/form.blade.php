@extends('layouts.apputama')

@section('main')
<div class="container col-xs-12 col-sm-6 col-md-8 mt-3 mb-3">
    <div class="row">
        <div class="col-lg">
            <form action="/layananmitra/create" method="post">
            @csrf
            <h1>Data Layanan Mitra</h1>
            <input type="hidden" name="paket_mitra" value="{{$request->id}}">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Panggilan</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama" name="nama" aria-describedby="nama" value="{{Auth::user()->name}}">
                        <small id="nama" class="form-text text-muted">Isi Nama pemesanan sesuai dengan KTP/SIM/PASPOR (tanpa ada gelar atau jabatan)</small>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="nomer">No.HP Anda</label>
                            <input type="text" class="form-control @error('nomerhp') is-invalid @enderror" id="nomerhp" name="nomerhp" placeholder="08xxxxxxxxxx" value="{{Auth::user()->nomer}}">
                            <small id="nomerhp" class="form-text text-muted">contoh : +628222233312 kode negara +62 dan nomer hp 08222233312</small>
                        </div>
                        <div class="col">
                            <label for="email">Email Anda</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="xxxx@gmail.com" value="{{Auth::user()->email}}">
                            <small id="nama" class="form-text text-muted">contoh : bookingcart@gmail.com</small>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3 ">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection