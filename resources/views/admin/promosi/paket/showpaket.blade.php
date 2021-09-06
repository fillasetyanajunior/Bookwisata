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
                        <li class="breadcrumb-item"><a href="#">Promosi</a></li>
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
            <button type="button" class="btn btn-primary my-3" id="addpaket" data-toggle="modal"
                data-target="#PaketModal">
                Tambah {{$title}}
            </button>
            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Owner Company</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($paket as $Paket)
                    <tr></tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$Paket->nama}}</td>
                    <td>{{$Paket->company}} Company</td>
                    <td>
                        <button type="button" class="btn btn-warning" id="editpaket" data-id="{{$Paket->id}}"
                            data-toggle="modal" data-target="#PaketModal">
                            Edit
                        </button>
                        <form action="/paket/{{$Paket->id}}" method="post" class="d-inline">
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
<div class="modal fade" id="PaketModal" tabindex="-1" aria-labelledby="PaketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PaketModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_paket">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama" class="form-label">Nama Paket Wisata</label>
                                <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" placeholder="Nama" value="{{old('nama')}}">
                            </div>
                            <div class="col mb-3">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" class="form-control  @error('company') is-invalid @enderror"
                                    id="company" name="company" placeholder="company" value="{{old('company')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Provinsi</label>
                                <select class="form-select form-control  @error('provinsi') is-invalid @enderror"
                                    aria-label="Default select example" id="form_prov" name="provinsi">
                                    <option selected disabled>Pilih Provinsi</option>
                                    @foreach ($provinsi as $item)
                                    <option value="{{ $item['kode'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Kabupaten/Kota</label>
                                <select class="form-select form-control  @error('kabupaten') is-invalid @enderror"
                                    aria-label="Default select example" id="form_kab" name="kabupaten">
                                    <option selected>Pilih Kota</option>
                                    @foreach ($kabupaten as $item)
                                    <option value="{{ $item['kode'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="review" class="form-label">Review</label>
                            <textarea class="form-control @error('review') is-invalid @enderror" id="review" rows="5"
                                name="review"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control  @error('harga') is-invalid @enderror" id="harga"
                                placeholder="Harga" name="harga" value="{{old('harga')}}">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto Unit</label>
                            <input class="form-control  @error('formFile') is-invalid @enderror" type="file" id="formFile"
                                name="formFile">
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Foto Detail</label>
                            <input class="form-control  @error('gambar') is-invalid @enderror" type="file" id="gambar"
                                name="gambar[]" multiple>
                            <small id="emailHelp" class="form-text text-muted">Masukan Beberpa Foto</small>
                        </div>
                    </div>
                    <div class="modal-footer footer_paket">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
