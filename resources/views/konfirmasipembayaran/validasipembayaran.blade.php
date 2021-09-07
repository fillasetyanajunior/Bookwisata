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
                        <li class="breadcrumb-item"><a href="#">Konfrimasi</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-sm-11 mx-4">
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                    value="{{$konfirmasi->nama}}">
            </div>
            <div class="mb-3">
                <label for="qr_kode" class="form-label">Kode Transaksi</label>
                <input type="text" class="form-control" id="qr_kode" name="qr_kode" value="{{$konfirmasi->qrcode}}">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">File Konfrimasi</label>
            </div>
            <form action="/konfirmasi_download/pembayaran/{{$konfirmasi->id}}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary">Download</button>
            </form>
        </div>
    </div>
</div>
@endsection
