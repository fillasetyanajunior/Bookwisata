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
                <label for="company" class="form-label">Company</label>
                <input type="text" class="form-control companydetailriwayat" id="company " name="company " value="{{$riwayat->company}}">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control namadetailriwayat" id="nama " name="nama " value="{{$riwayat_detail->nama}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control emaildetailriwayat" id="email " name="email" value="{{$riwayat_detail->email}} ">
            </div>
            <div class="mb-3">
                <label for="nomerhp" class="form-label">Nomer Hp</label>
                <input type="text" class="form-control nomerhpdetailriwayat" id="nomerhp " name="nomerhp" value="{{$riwayat_detail->nomerhp}} ">
            </div>
            <div class="mb-3">
                <label for="nama_pilihan" class="form-label">Nama Pilihan</label>
                <input type="text" class="form-control pilihandetailriwayat" id="nama_pilihan " name="nama_pilihan" value="{{$riwayat_detail->nama_pilihan}} ">
            </div>
            <div class="mb-3">
                @php
                $tipe = null;
                    if($riwayat_detail->tipe == 31){
                    $tipe = 'Small Bus';
                    }
                    elseif($riwayat_detail->tipe == 32){
                        $tipe = 'Medium Bus';
                    }
                    elseif($riwayat_detail->tipe == 33){
                        $tipe = 'Big Bus';
                    }
                    elseif($riwayat_detail->tipe == 21){
                        $tipe = 'Sedan';
                    }
                    elseif($riwayat_detail->tipe == 22){
                        $tipe = 'MVP';
                    }
                    elseif($riwayat_detail->tipe == 23){
                        $tipe = 'LMVP';
                    }
                    elseif($riwayat_detail->tipe == '-'){
                        $tipe = $riwayat_detail->tipe;
                    }
                    else{
                        foreach ($tipes as $item){
                            if ($item->id == $riwayat_detail->tipe){
                                $tipe = $item->tipe;
                            }
                        }
                    }
                @endphp
                <label for="tipe" class="form-label">Tipe</label>
                <input type="text" class="form-control tipedetailriwayat" id="tipe " name="tipe" value="{{$tipe}} ">
            </div>
            <div class="mb-3">
                <label for="jumlah_sit" class="form-label">Jumlah Sit</label>
                <input type="text" class="form-control jumlahsitdetailriwayat" id="jumlah_sit " name="jumlah_sit" value="{{$riwayat_detail->jumlah_sit}} ">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control hargadetailriwayat" id="harga " name="harga" value="{{$riwayat_detail->harga}} ">
            </div>
            <div class="mb-3">
                <label for="jumlahpesanan" class="form-label">Jumlah Pesanan</label>
                <input type="text" class="form-control jumlahpesanandetailriwayat" id="jumlahpesanan " name="jumlahpesanan" value="{{$riwayat_detail->jumlahpesanan}} ">
            </div>
            <div class="mb-3">
                <label for="potongan" class="form-label">Potongan</label>
                <input type="text" class="form-control potongandetailriwayat" id="potongan " name="potongan" value="{{$riwayat_detail->potongan}} ">
            </div>
            <div class="mb-3">
                <label for="hari" class="form-label">Hari</label>
                <input type="text" class="form-control haridetailriwayat" id="hari " name="hari" value="{{$riwayat_detail->hari}} ">
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control totaldetailriwayat" id="total " name="total" value="{{$riwayat_detail->total}} ">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal Pemakaian</label>
                <input type="text" class="form-control datedetailriwayat" id="date " name="date" value="{{date('d-F-Y',strtotime($riwayat_detail->date))}} ">
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
                <input type="text" class="form-control isactivedetailriwayat" name="is_active " id="is_active " value="{{$is_active}}">
            </div>
            <div class="mb-3">
                <label for="note">Note Customer</label>
                <textarea class="form-control notedetailriwayat" id="note " rows="3">{{$riwayat->note}}</textarea>
            </div>
        </div>
    </div>
</div>
 
@endsection

