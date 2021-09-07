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
                        <li class="breadcrumb-item"><a href="#">Management</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div>
            </div>
        </div>>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-sm-11 mx-4">
            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nomer Hp</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Paket Mitra</th>
                        <th scope="col">Waktu Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($transaksi as $transaksi)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$transaksi->nama}}</td>
                        <td>{{$transaksi->email}}</td>
                        <td>{{$transaksi->nomer}}</td>
                        <td>{{$transaksi->alamat}}</td>
                        <td>
                            @if ($transaksi->paket_mitra == 1)
                            3 Bulan
                            @elseif($transaksi->paket_mitra == 2)
                            6 Bulan
                            @elseif($transaksi->paket_mitra == 3)
                            2 Tahun
                            @elseif($transaksi->paket_mitra == 4)
                            1 Tahun
                            @else
                            Trial 1 Bulan
                            @endif
                        </td>
                        <td>{{$transaksi->waktu_payment}}</td>
                    </tr>
                    <?php $i++;?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
