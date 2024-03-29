@extends('layouts.appdashboard')
@section('title',$title)
@section('main')
<x-slidebar></x-slidebar>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Utama</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-sm-11 mx-4 my-4">
            <form action="/konfirmasi/{{$riwayat->id}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" class="form-control companykonfirmasi" id="company " name="company "
                        value="{{$riwayat->company}}">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control namakonfirmasi" id="nama" name="nama "
                        value="{{$riwayat->nama}}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control emailkonfirmasi" id="email " name="email"
                        value="{{$riwayat->email}} ">
                </div>
                <div class="mb-3">
                    <label for="nomerhp" class="form-label">Nomer Hp</label>
                    <input type="text" class="form-control nomerhpkonfirmasi" id="nomerhp " name="nomerhp"
                        value="{{$riwayat->nomerhp}} ">
                </div>
                <div class="mb-3">
                    <label for="nama_pilihan" class="form-label">Nama Pilihan</label>
                    <input type="text" class="form-control pilihankonfirmasi" id="nama_pilihan " name="nama_pilihan"
                        value="{{$riwayat->nama_pilihan}} ">
                </div>
                <div class="mb-3">
                    @php
                    $tipe = null;
                    if($riwayat->tipe == 31){~
                    $tipe = 'Small Bus';
                    }
                    elseif($riwayat->tipe == 32){
                    $tipe = 'Medium Bus';
                    }
                    elseif($riwayat->tipe == 33){
                    $tipe = 'Big Bus';
                    }
                    elseif($riwayat->tipe == 21){
                    $tipe = 'Sedan';
                    }
                    elseif($riwayat->tipe == 22){
                    $tipe = 'MVP';
                    }
                    elseif($riwayat->tipe == 23){
                    $tipe = 'LMVP';
                    }
                    elseif($riwayat->tipe == 41){
                    $tipe = 'Bundling';
                    }
                    elseif($riwayat->tipe == 42){
                    $tipe = 'Non Bundling';
                    }
                    elseif($riwayat->tipe == 51){
                    $tipe = 'Gunung';
                    }
                    elseif($riwayat->tipe == 52){
                    $tipe = 'Lipat';
                    }
                    elseif($riwayat->tipe == 53){
                    $tipe = 'Balap';
                    }
                    elseif($riwayat->tipe == 61){
                    $tipe = 'Bundling';
                    }
                    elseif($riwayat->tipe == 62){
                    $tipe = 'Non Bundling';
                    }
                    elseif($riwayat->tipe == '-'){
                    $tipe = $riwayat->tipe;
                    }
                    else{
                    foreach ($tipes as $item){
                    if ($item->id == $riwayat->tipe){
                    $tipe = $item->tipe;
                    }
                    }
                    }
                    @endphp
                    <label for="tipe" class="form-label">Tipe</label>
                    <input type="text" class="form-control tipekonfirmasi" id="tipe " name="tipe" value="{{$tipe}} ">
                </div>
                <div class="mb-3">
                    <label for="jumlah_sit" class="form-label">Jumlah Sit</label>
                    <input type="text" class="form-control jumlahsitkonfirmasi" id="jumlah_sit " name="jumlah_sit"
                        value="{{$riwayat->jumlah_sit}} ">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control hargakonfirmasi" id="harga hargakonfirmasi" name="harga"
                        value="{{$riwayat->harga}} ">
                </div>
                <div class="mb-3">
                    <label for="jumlahpesanan" class="form-label">Jumlah Pesanan</label>
                    <input type="text" class="form-control jumlahpesanankonfirmasi" id="jumlahpesanan "
                        name="jumlahpesanan" value="{{$riwayat->jumlahpesanan}} ">
                </div>
                <div class="mb-3">
                    <label for="potongan" class="form-label">Admin</label>
                    <input type="text" class="form-control potongankonfirmasi" id="potongan " name="potongan"
                        value="{{$riwayat->potongan}} ">
                </div>
                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <input type="text" class="form-control harikonfirmasi" id="hari " name="hari"
                        value="{{$riwayat->hari}} ">
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="text" class="form-control totalkonfirmasi" id="total " name="total"
                        value="{{$riwayat->total}} ">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal Pemakaian</label>
                    <input type="text" class="form-control datekonfirmasi" id="date " name="date"
                        value="{{date('d-F-Y',strtotime($riwayat->date))}} ">
                </div>
                <div class="mb-3">
                    <label for="note">Note Customer</label>
                    <textarea class="form-control notekonfirmasi" id="note" rows="3">{{$riwayat->note}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="is_active" class="form-label">Status Pesanan</label>
                    <select class="form-select form-control" aria-label="Default select example" id="is_active"
                        name="is_active">
                        <option value="">Select Status</option>
                        <option value="1" @if ($riwayat->is_active == 1) selected @endif >Waitting</option>
                        <option value="2" @if ($riwayat->is_active == 2) selected @endif >Hold</option>
                        <option value="3" @if ($riwayat->is_active == 3) selected @endif >Confirmed</option>
                        <option value="5" @if ($riwayat->is_active == 5) selected @endif >Cancel</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="time_payment" class="form-label">Waktu Pembayaran</label>
                    <select class="form-select form-control" aria-label="Default select example" id="time_payment"
                        name="time_payment">
                        <option value="">Select Waktu</option>
                        <option value="1">4 Jam</option>
                        <option value="2">12 Jam</option>
                        <option value="3">24 Jam</option>
                    </select>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="cost" value="option1">
                    <label class="form-check-label" for="cost">Cost</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" id="event" value="option2">
                    <label class="form-check-label" for="event">Diskon</label>
                </div>
                <div class="mb-3 cost">
                    <label for="cost" class="form-label">Tambahan Biaya</label>
                    <input type="text" class="form-control" id="cost " name="cost">
                </div>
                <div class="mb-3 event">
                    <label for="event" class="form-label">Diskon</label>
                    <input type="text" class="form-control" id="event " name="event">
                </div>
                <button type="submit" class="btn btn-primary my-3" name="submit">Konfirmasi</button>
            </form>
        </div>
    </div>
</div>
@endsection
