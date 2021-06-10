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
                    <li class="breadcrumb-item"><a href="#">Konfrimasi</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="d-flex justify-content-center">
        <div class="col-sm-11 mx-4">
            <form action="{{route('store_konfirmasi_pembayaran')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="{{old('nama_produk')}}">
                </div>
                <div class="mb-3">
                    <label for="qr_kode" class="form-label">Kode Transaksi</label>
                    <input type="text" class="form-control @error('qr_kode') is-invalid @enderror" id="qr_kode" name="qr_kode" placeholder="Kode Pesanan" value="{{old('qr_kode')}}">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">File Konfrimasi</label>
                    <input class="form-control  @error('filekonfirmasi') is-invalid @enderror" type="file" id="formFile" name="filekonfirmasi" >
                </div>
                <div class="mb-3">
                    <label for="pilihan_konfirmasi" class="form-label">Pilihan Konfrimasi Pembayaran</label>
                    <select class="form-control" id="pilihan_konfirmasi" name="pilihan_konfirmasi">
                        <option value="">Pilihan</option>
                        <option value="1">Pembayaran Pesanan</option>
                        <option value="2">Pembayaran Mitra</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mb-5">Submit</button>
            </form>
        </div>
    </div>
</div>
 
@endsection

