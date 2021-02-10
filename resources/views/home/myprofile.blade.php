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
        <div class="col-sm-11 mx-4">
          @foreach ($user as $user)
            <img src="{{asset('profile/' . $user->avatar)}}" class="rounded mx-auto d-block" style="width: 200px">
            <form action="/myprofile/{{$user->id}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
              </div>
              <div class="mb-3">
                <label for="nomer" class="form-label">Nomer Hp</label>
                <input type="text" class="form-control" id="nomer" name="nomer" value="{{$user->nomer}}">
              </div>
              <div class="mb-3">
                <label for="formFile" class="form-label">File Foto</label>
                <input class="form-control @error('avatar') is-invalid @enderror" type="file" id="formFile" name="avatar">
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          @endforeach
        </div>
    </div>
  </div>

@endsection