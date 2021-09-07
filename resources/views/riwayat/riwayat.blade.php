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
        <div class="col-sm-12 mx-2">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <input type="text" class="form-control my-3 col-2" id="myInput" placeholder="Search">
            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Kode QR</th>
                        @if (request()->user()->role == 1 || request()->user()->role == 2)
                        <th scope="col">Aksi</th>
                        <th scope="col">Waktu Pembayaran</th>
                        @else
                        <th scope="col">Aksi</th>
                        <th scope="col">Waktu Pembayaran</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="Table">
                    <?php $i = 1;?>
                    @foreach ($riwayat as $riwayat)
                    <tr>
                        <th scope="row">{{$i}} </th>
                        <td>{{$riwayat->nama}} </td>
                        <td>{{$riwayat->email}} </td>
                        <td>
                            @if ($riwayat->is_active == 1)
                            Waitting
                            @elseif($riwayat->is_active == 2)
                            Hold
                            @elseif($riwayat->is_active == 3)
                            Confirmed
                            @elseif($riwayat->is_active == 4)
                            Expired
                            @else
                            Cencel
                            @endif
                        </td>
                        <td>{{$riwayat->qr_code}}</td>
                        @if (request()->user()->role == 1 || request()->user()->role == 2)
                        <td>
                            @if ($riwayat->is_active == 4 || $riwayat->is_active == 5)
                            @elseif ($riwayat->is_active == 3)
                            <a href="pdf/{{$riwayat->id}}" class="btn btn-success d-inline">Confirm</a>
                            <a href="/detailriwayat/{{$riwayat->id}}" class="btn btn-primary">Detail</a>
                            @else
                            <a href="/konfirmasi/{{$riwayat->id}}" class="btn btn-primary">Konfirmasi</a>
                            @endif
                        </td>
                        <td>
                            @if ($riwayat->waktu_payment == null)
                            @else
                            <p class="time" id="waktu" limit="{{$limit}}" content="{{$riwayat->waktu_payment}}"
                                itemid="{{$riwayat->id}}">{{date('d-F-Y H:i:s',strtotime($riwayat->waktu_payment))}} WIB
                            </p>
                            @endif
                        </td>
                        @else
                        <td>
                            @if ($riwayat->is_active == 4 || $riwayat->is_active == 5)
                            @elseif ($riwayat->is_active == 3)
                            <a href="pdf/{{$riwayat->id}}" class="btn btn-success d-inline">Confirm</a>
                            @endif
                            <a href="/detailriwayat/{{$riwayat->id}}" class="btn btn-primary">Detail</a>
                        </td>
                        <td>
                            @if ($riwayat->waktu_payment == null)
                            @else
                            <p class="time" id="waktu" limit="{{$limit}}" content="{{$riwayat->waktu_payment}}"
                                itemid="{{$riwayat->id}}">{{date('d-F-Y H:i:s',strtotime($riwayat->waktu_payment))}} WIB
                            </p>
                            @endif
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
