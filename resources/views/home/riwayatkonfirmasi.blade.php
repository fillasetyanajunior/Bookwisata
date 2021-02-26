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
            <form action="/konfirmasi/{{$riwayat->id}}" method="POST">
                @csrf
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
                    <label for="is_active" class="form-label">Konfirmasi</label>
                    <select class="form-select form-control" aria-label="Default select example" id="is_active" name="is_active">
                        <option value="">Select Konfirmasi</option>
                        <option value="1" @if ($riwayat->is_active == 1) selected @endif >Waitting</option>
                        <option value="2" @if ($riwayat->is_active == 2) selected @endif >Hold</option>
                        <option value="3" @if ($riwayat->is_active == 3) selected @endif >Confirmed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Konfirmasi</button>
            </form>
        </div>
    </div>
</div>
 
@endsection

