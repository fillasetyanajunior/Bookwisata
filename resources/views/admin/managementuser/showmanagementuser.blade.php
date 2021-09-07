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
        </div>
    </div>
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
                            <button type="button" class="btn btn-warning" id="editmanagementuser"
                                data-id="{{$User->id}}" data-toggle="modal"
                                data-target="#ManagemenUserModal">Edit</button>
                        </td>
                    </tr>
                    <?php $i++;?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="ManagemenUserModal" tabindex="-1" aria-labelledby="ManagemenUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ManagemenUserModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_managementuser">
                <form action="" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select form-control" aria-label="Default select example" id="role"
                                name="role">
                                <option selected>Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Mitra</option>
                                <option value="3">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer footer_managementuser">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
