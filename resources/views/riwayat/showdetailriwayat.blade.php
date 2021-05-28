@extends('layouts.appdashboard')

@section('title',$title)

@section('main')
    
<x-slidebar></x-slidebar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Utama</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="d-flex justify-content-center">
        <div class="col-sm-11 mx-4 my-4">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$riwayat->nama}} ">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$riwayat->email}} ">
            </div>
            <div class="mb-3">
                <label for="nomerhp" class="form-label">Nomer Hp</label>
                <input type="text" class="form-control" id="nomerhp" name="nomerhp" value="{{$riwayat->nomerhp}} ">
            </div>
            <div class="mb-3">
                <label for="nama_pilihan" class="form-label">Nama Pilihan</label>
                <input type="text" class="form-control" id="nama_pilihan" name="nama_pilihan" value="{{$riwayat->nama_pilihan}} ">
            </div>
            <div class="mb-3">
                @php
                    @if($riwayat->tipe == 31)
                        $tipe = 'Small Bus';
                    @elseif($riwayat->tipe == 32)
                        $tipe = 'Medium Bus';
                    @elseif($riwayat->tipe == 33)
                        $tipe = 'Big Bus';
                    @elseif($riwayat->tipe == 21)
                        $tipe = 'Sedan';
                    @elseif($riwayat->tipe == 22)
                        $tipe = 'MVP';
                    @elseif($riwayat->tipe == 23)
                        $tipe = 'LMVP';
                    @elseif($riwayat->tipe == '-')
                        $tipe = $riwayat->tipe;
                    @else
                        @foreach ($tipe as $item)
                            @if ($item->id == $riwayat->tipe)
                                $tipe = $item->tipe;
                            @endif
                        @endforeach
                    @endif
                @endphp
                <label for="tipe" class="form-label">Tipe</label>
                <input type="text" class="form-control" id="tipe" name="tipe" value="{{$tipe}} ">
            </div>
            <div class="mb-3">
                <label for="jumlah_sit" class="form-label">Jumlah Sit</label>
                <input type="text" class="form-control" id="jumlah_sit" name="jumlah_sit" value="{{$riwayat->jumlah_sit}} ">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="{{$riwayat->harga}} ">
            </div>
            <div class="mb-3">
                <label for="jumlahpesanan" class="form-label">Jumlah Pesanan</label>
                <input type="text" class="form-control" id="jumlahpesanan" name="jumlahpesanan" value="{{$riwayat->jumlahpesanan}} ">
            </div>
            <div class="mb-3">
                <label for="potongan" class="form-label">Potongan</label>
                <input type="text" class="form-control" id="potongan" name="potongan" value="{{$riwayat->potongan}} ">
            </div>
            <div class="mb-3">
                <label for="hari" class="form-label">Hari</label>
                <input type="text" class="form-control" id="hari" name="hari" value="{{$riwayat->hari}} ">
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control" id="total" name="total" value="{{$riwayat->total}} ">
            </div>
            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi</label>
                <input type="text" class="form-control" id="durasi" name="durasi" value="{{$riwayat->durasi}} ">
            </div>
            <div class="mb-3">
                @php
                    if ($riwayat->is_active == 1){
                        $is_active = 'Waitting';
                    }else if ($riwayat->is_active == 2) {
                        $is_active = 'Hold';
                    }else if ($riwayat->is_active == 3) {
                        $is_active = 'Confirmed';
                    }else if ($riwayat->is_active == 5) {
                        $is_active = 'Cancel';
                    }
                    @endphp
                <label for="is_active" class="form-label">Status Pesanan</label>
                <input type="text" name="is_active" id="is_active" value="{{$is_active}}">
            </div>
            <div class="mb-3">
                <label for="note">Note Customer</label>
                <textarea class="form-control" id="note" rows="3">{{$riwayat->note}}</textarea>
            </div>
        </div>
    </div>
</div>
 
@endsection

