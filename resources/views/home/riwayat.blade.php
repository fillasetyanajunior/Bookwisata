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
        <div class="col-sm-12 mx-2">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nomer Hp</th>
                        <th scope="col">Pemesanan</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        @if (request()->user()->role == 1 || request()->user()->role == 2)
                          <th scope="col">Aksi</th>
                        @else
                          
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;?>
                    @foreach ($riwayat as $riwayat)
                    <tr>
                        <th scope="row">{{$i}} </th>
                        <td>{{$riwayat->nama}} </td>
                        <td>{{$riwayat->email}} </td>
                        <td>{{$riwayat->nomerhp}} </td>
                        <td>{{$riwayat->nama_pilihan}} </td>
                        <td>
                          @if($riwayat->tipe == 31)
                            Small Bus
                          @elseif($riwayat->tipe == 32)
                            Medium Bus
                          @elseif($riwayat->tipe == 33)
                            Big Bus
                          @elseif($riwayat->tipe == 21)
                            Sedan
                          @elseif($riwayat->tipe == 22)
                            MVP
                          @elseif($riwayat->tipe == 23)
                            LMVP
                          @elseif($riwayat->tipe == '-')
                            {{$riwayat->tipe}}
                          @else
                            @foreach ($tipe as $item)
                                @if ($item->id == $riwayat->tipe)
                                    {{$item->tipe}}
                                @endif
                            @endforeach
                          @endif    
                        </td>
                        <td>{{$riwayat->jumlahpesanan}} </td>
                        <td>{{$riwayat->hari}} </td>
                        <td>{{$riwayat->date}} </td>
                        <td>{{$riwayat->total}} </td>
                        <td>
                            @if ($riwayat->is_active == 1)
                                Hold
                            @elseif($riwayat->is_active == 2)
                                Cancel
                            @else
                                Confirmed
                            @endif
                        </td>
                         @if (request()->user()->role == 1 || request()->user()->role == 2)
                        <td>
                          <a href="/konfirmasi/{{$riwayat->id}}" class="btn btn-primary">Konfirmasi</a>
                        </td>
                        @else
                          
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

