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
                        <li class="breadcrumb-item"><a href="#">Layout</a></li>
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
            <button type="button" class="btn btn-primary mb-3" id="addaccessmenu" data-toggle="modal"
                data-target="#AccessMenuModal">Tambah
                Menu</button>
            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Nama Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($access as $Access)
                    <?php
                    $id = $Access->id;
                    $query =  DB::table('menu')
                                ->join('access_menu','access_menu.menu_id','=','menu.id')
                                ->select('menu')
                                ->where('access_menu.id', '=' ,$id)
                                ->get();?>
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>
                            @foreach ($query as $item)
                            {{$item->menu}}
                            @endforeach
                        </td>
                        <td>
                            @if ($Access->role_id == 1)
                            Admin
                            @elseif($Access->role_id == 2)
                            Mitra
                            @else
                            User
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning" data-id="{{$Access->id}}" id="editaccessmenu"
                                data-toggle="modal" data-target="#AccessMenuModal">Edit</button>
                            <form action="/accessmenu/delete/{{$Access->id}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('yakin');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++;?>
                    @endforeach
                </tbody>
            </table>
            {{$access->links()}}
            <br>
        </div>
    </div>
</div>
<div class="modal fade" id="AccessMenuModal" tabindex="-1" aria-labelledby="AccessMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AccessMenuModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_accessmenu">
                <form action="" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="menu" class="form-label">Nama Menu</label>
                            <select class="form-select form-control @error('menu_id') is-invalid @enderror"
                                aria-label="Default select example" id="menu_id" name="menu_id">
                                <option value="">Select menu</option>
                                @foreach ($menu as $item)
                                <option value="{{$item->id}}">{{$item->menu}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Nama Role</label>
                            <select class="form-select form-control @error('role_id') is-invalid @enderror"
                                aria-label="Default select example" id="role_id" name="role_id">
                                <option value="">Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Mitra</option>
                                <option value="3">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer footer_accessmenu">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
