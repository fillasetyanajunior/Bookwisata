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
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if (request()->user()->role == 1)
            
            @else
                <a href="{{route('create_konfirmasi_pembayaran')}}" class="btn btn-primary my-3">Konfrimasi</a>
            @endif

            <select class="form-control pilihankonfrimasi d-inline my-3 col-2">
                <option value="1">Pembayaran Pesanan</option>
                <option value="2">Pembayaran Mitra</option>
            </select>

            <table class="table bg-info konfirmasipembayaran">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Kode Transaksi</th>
                        @if (request()->user()->role == 1)
                            <th scope="col">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($konfirmasi as $konfirmasi)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$konfirmasi->nama}} </td>
                        <td>{{$konfirmasi->qrcode}} </td>
                        @if (request()->user()->role == 1)
                        <td>
                            <a class="btn btn-success" href="/konfirmasi_pembayaran/{{$konfirmasi->id}}">View</a>
                        </td>
                        @endif
                    </tr>
                    <?php $i++;?>
                    @endforeach
                </tbody>
            </table>
            <table class="table bg-info konfirmasimitra">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kode Transaksi</th>
                        @if (request()->user()->role == 1)
                            <th scope="col">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($mitra as $mitra)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$mitra->nama}} </td>
                        <td>{{$mitra->kode}} </td>
                        @if (request()->user()->role == 1)
                        <td>
                            <a class="btn btn-success" href="/konfirmasi_mitra/{{$mitra->id}}">View</a>
                        </td>
                        @endif
                    </tr>
                    <?php $i++;?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
 
@endsection

