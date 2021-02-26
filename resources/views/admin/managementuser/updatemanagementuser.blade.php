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
            <form action="/managementuser/{{$user->id}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select form-control" aria-label="Default select example" id="role" name="role">
                        <option selected>Select Role</option>
                        <option value="1"@if ($user->role == 1) selected @endif>Admin</option>
                        <option value="2"@if ($user->role == 2) selected @endif>Mitra</option>
                        <option value="3"@if ($user->role == 3) selected @endif>User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Sumbit</button>
            </form>
        </div>
    </div>
</div>
 
@endsection

