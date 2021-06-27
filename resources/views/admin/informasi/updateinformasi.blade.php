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
            <form action="/informasi/{{$informasi->id}}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
               <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$informasi->title}}">
                </div>
                <div class="mb-3">
                    <label for="informasi">Isi Informasi</label>
                    <textarea class="form-control" id="informasi" rows="3" name="informasi">{{$informasi->informasi}}</textarea>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input check" id="check">
                    <label class="form-check-label" for="check">Foto</label>
                </div>
                <div class="mb-3 fileinformasi">
                    <label for="file">Foto</label>
                    <input type="file" class="form-control-file" id="file" name="file">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Sumbit</button>
            </form>
        </div>
    </div>
</div>
 
@endsection

