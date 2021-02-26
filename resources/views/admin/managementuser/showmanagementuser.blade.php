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
        <div class="col-sm-11 mx-4">
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
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($user as $User)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$User->name}}</td>
                        <td>{{$User->email}}</td>
                        <td>{{$User->nomer}}</td>
                        <td>
                            @if ($User->role == 1)
                                Admin
                            @elseif($User->role == 2)
                                Mitra
                            @else
                                User
                            @endif
                        </td>
                        <td>
                            @if ($User->is_active == 1)
                                Active
                            @else
                                Isactive
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-warning" href="/managementuser/edit/{{$User->id}}">Edit</a>
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

