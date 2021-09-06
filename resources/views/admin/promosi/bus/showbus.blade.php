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
            <button type="button" data-toggle="modal" data-target="#BusModal" id="addbus"
                class="btn btn-primary my-3">Tambah
                {{$title}}</button>
            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Bus</th>
                        <th scope="col">PO</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($bus as $Bus)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$Bus->nama}}</td>
                        <td>{{$Bus->po}}</td>
                        <td>
                            <button type="button" data-toggle="modal" data-id="{{$Bus->id}}" data-target="#BusModal"
                                id="editbus" class="btn btn-primary my-3">Edit</button>
                            <form action="/bus/delete/{{$Bus->id}}" method="post" class="d-inline">
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
<div class="modal fade" id="BusModal" tabindex="-1" aria-labelledby="BusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="BusModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="body_bus">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama" class="form-label">Nama Bus</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" placeholder="Nama" value="{{old('nama')}}">
                            </div>
                            <div class="col mb-3">
                                <label for="po" class="form-label">PO</label>
                                <input type="text" class="form-control  @error('po') is-invalid @enderror" id="po"
                                    name="po" placeholder="PO" value="{{old('po')}}">
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
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tipe</label>
                                <select class="form-select form-control  @error('tipe') is-invalid @enderror"
                                    aria-label="Default select example" id="tipe" name="tipe">
                                    <option value="">Pilih Tipe Bus</option>
                                    <option value="31">Small Bus</option>
                                    <option value="32">Medium Bus</option>
                                    <option value="33">Big Bus</option>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Transmisi</label>
                                <select class="form-select form-control  @error('transmisi') is-invalid @enderror"
                                    aria-label="Default select example" id="transmisi" name="transmisi">
                                    <option value="">Pilih Transmii</option>
                                    <option value="1">Manual</option>
                                    <option value="2">Automatic</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">AC</label>
                                <select class="form-select form-control  @error('ac') is-invalid @enderror"
                                    aria-label="Default select example" id="ac" name="ac">
                                    <option value="">Pilih Ac</option>
                                    <option value="1">Ya</option>
                                    <option value="2">Tidak</option>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Overland</label>
                                <select class="form-select form-control  @error('overland') is-invalid @enderror"
                                    aria-label="Default select example" id="overland" name="overland">
                                    <option value="">Pilih Overland</option>
                                    <option value="1">Ya</option>
                                    <option value="2">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_sit" class="form-label">Jumlah Sit</label>
                            <input type="text" class="form-control  @error('jumlah_sit') is-invalid @enderror"
                                id="jumlah_sit" placeholder="Jumlah Sit" name="jumlah_sit"
                                value="{{old('jumlah_sit')}}">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control  @error('harga') is-invalid @enderror" id="harga"
                                placeholder="Harga" name="harga" value="{{old('harga')}}">
                        </div>
                        <div class="mb-3">
                            <label for="review" class="form-label">Review</label>
                            <textarea class="form-control @error('review') is-invalid @enderror" id="review" rows="5"
                                name="review"></textarea>
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
                    <div class="modal-footer footer_bus">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
