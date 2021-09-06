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
            <button type="button" class="btn btn-primary my-3" id="addhotel" data-toggle="modal" data-target="#HotelModal">
                Tambah {{$title}}
            </button>

            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Hotel</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($hotel as $Hotel)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$Hotel->nama}}</td>
                        <td>{{$Hotel->alamat}}</td>
                        <td>
                            <button type="button" class="btn btn-warning" data-id="{{$Hotel->id}}" id="edithotel"
                                data-toggle="modal" data-target="#HotelModal">
                                Edit
                            </button>
                            <form action="/hotel/delete/{{$Hotel->id}}" method="post" class="d-inline">
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
<div class="modal fade" id="HotelModal" tabindex="-1" aria-labelledby="HotelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="HotelModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_hotel">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Hotel</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" placeholder="Nama" value="{{old('nama')}}">
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
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tipe Kamar</label>
                                <select class="form-select form-control  @error('tipe') is-invalid @enderror"
                                    aria-label="Default select example" id="tipe" name="tipe">
                                    <option value="">Pilih Tipe Kamar</option>
                                    @foreach ($tipe as $item)
                                    <option value="{{$item->id}}">{{$item->tipe}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Jumlah Bad</label>
                                <select class="form-select form-control  @error('bad') is-invalid @enderror"
                                    aria-label="Default select example" id="bad" name="bad">
                                    <option value="">Pilih Jumlah Bad</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">1+Extra</option>
                                    <option value="5">2+Extra</option>
                                    <option value="6">3+Extra</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="review" class="form-label">Review</label>
                            <textarea class="form-control @error('review') is-invalid @enderror" id="review" rows="5"
                                name="review">{{old('review')}}</textarea>
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
                    <div class="modal-footer footer_hotel">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
