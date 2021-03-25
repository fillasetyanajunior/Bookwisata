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
                        <li class="breadcrumb-item"><a href="#">Layout</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="d-flex justify-content-center">
        <div class="col-sm-11 mx-4 my-4">
            <form action="{{route('store_informasi')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="informasi">Isi Informasi</label>
                    <textarea class="form-control @error('informasi') is-invalid @enderror" id="informasi" rows="3" name="informasi"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Sumbit</button>
            </form>
        </div>
    </div>
</div>
 
@endsection

