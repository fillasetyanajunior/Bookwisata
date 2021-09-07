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
            <button type="button" class="btn btn-primary mb-3" id="addsubmenu" data-toggle="modal"
                data-target="#SubMenuModal">Tambah Menu</button>
            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Nama Sub Menu</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Url</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($submenu as $Submenu)
                    <?php
                    $id = $Submenu->id;
                    $query =  DB::table('menu')
                                ->join('sub_menu','sub_menu.menu_id','=','menu.id')
                                ->select('menu')
                                ->where('sub_menu.id', '=' ,$id)
                                ->get()?>
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>
                            @foreach ($query as $item)
                            {{$item->menu}}
                            @endforeach
                        </td>
                        <td>{{$Submenu->sub_menu}}</td>
                        <td>{{$Submenu->icon}}</td>
                        <td>{{$Submenu->url}}</td>
                        <td>
                            <button type="button" class="btn btn-warning" id="editsubmenu" data-id="{{$Submenu->id}}"
                                data-toggle="modal" data-target="#SubMenuModal">Edit</button>
                            <form action="/submenu/delete/{{$Submenu->id}}" method="post" class="d-inline">
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
        </div>
    </div>
</div>
<div class="modal fade" id="SubMenuModal" tabindex="-1" aria-labelledby="SubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SubMenuModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_submenu">
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
                            <label for="sub_menu" class="form-label">Nama Sub Menu</label>
                            <input type="text" class="form-control @error('sub_menu') is-invalid @enderror"
                                id="sub_menu" name="sub_menu">
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon"
                                name="icon">
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                                name="url">
                        </div>
                    </div>
                    <div class="modal-footer footer_submenu">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
