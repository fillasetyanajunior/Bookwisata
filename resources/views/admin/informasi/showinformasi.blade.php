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
            <button type="button" class="btn btn-primary mb-3" id="addinformasi" data-toggle="modal"
                data-target="#InformasiModal">Tambah Informasi</button>
            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($informasi as $informasis)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$informasis->title}}</td>
                        <td width="400px">
                            <button type="button" class="btn btn-warning" id="editinformasi"
                                data-id="{{$informasis->id}}" data-toggle="modal"
                                data-target="#InformasiModal">Edit</button>
                            <form action="/informasi/{{$informasis->id}}" method="post" class="d-inline">
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
<div class="modal fade" id="InformasiModal" tabindex="-1" aria-labelledby="InformasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="InformasiModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_informasi">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title">
                        </div>
                        <div class="mb-3">
                            <label for="informasi">Isi Informasi</label>
                            <textarea class="form-control @error('informasi') is-invalid @enderror" id="informasi"
                                rows="3" name="informasi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pilihinformasi">Pilih Informasi</label>
                            <select class="form-control" id="pilihinformasi" name="pilihinformasi">
                                <option value="">Pilih Informasi</option>
                                <option value="1">Informasi Umum</option>
                                <option value="2">Informasi Khusus</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="file">Foto</label>
                            <input type="file" class="form-control-file" id="file" name="file">
                            <small id="emailHelp" class="form-text text-muted">Opsional</small>
                        </div>
                    </div>
                    <div class="modal-footer footer_informasi">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
