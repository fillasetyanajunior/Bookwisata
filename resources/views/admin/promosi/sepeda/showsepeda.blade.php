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
                    <li class="breadcrumb-item"><a href="#">Promosi</a></li>
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

            <a href="{{route('create_sepeda')}}" class="btn btn-primary my-3">Tambah {{$title}}</a>
            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Sepeda</th>
                        <th scope="col">Owner Company</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($sepeda as $Sepeda)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$Sepeda->nama}}</td>
                        <td>{{$Sepeda->company}} Company</td>
                        <td>
                            <a class="btn btn-warning" href="/sepeda/{{$Sepeda->id}}">Edit</a>
                            <form action="/sepeda/{{$Sepeda->id}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('yakin');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++;?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
 
@endsection

