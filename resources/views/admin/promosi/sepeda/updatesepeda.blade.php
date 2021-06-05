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
                    <li class="breadcrumb-item"><a href="#">Postingan</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="d-flex justify-content-center">
        <div class="col-sm-11 mx-4">
        
            <form action="/sepeda/{{$sepeda->id}}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
                <div class="row">
                    <div class="col mb-3">
                        <label for="nama" class="form-label">Nama Sepeda</label>
                        <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" value="{{$sepeda->nama}}">
                    </div>
                    <div class="col mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control  @error('company') is-invalid @enderror" id="company" name="company" placeholder="company" value="{{$sepeda->company}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Provinsi</label>
                        <select class="form-select form-control  @error('provinsi') is-invalid @enderror" aria-label="Default select example" id="form_prov" name="provinsi">
                            <option disabled>Pilih Provinsi</option>
                            @foreach ($response as $item)
                            <option value="{{ $item['id'] }}" @if ($item['id'] == $sepeda->provinsi) selected @endif>{{ $item['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Kabupaten/Kota</label>
                        <select class="form-select form-control  @error('kabupaten') is-invalid @enderror" datas="{{$sepeda->kabupaten}}" id="form_kab" disabled  name="kabupaten">
                            <option >Pilih Kota</option>
                        </select>
                    </div>
                </div>
                <div class="col mb-3">
                    <label class="form-label">Tipe Sepeda</label>
                    <select class="form-select form-control  @error('tipe') is-invalid @enderror" aria-label="Default select example" name="tipe">
                        <option value="">Pilih Tipe Sepeda</option>
                        <option value="51" @if ($sepeda->tipe == 51) selected @endif>Gunung</option>
                        <option value="52" @if ($sepeda->tipe == 52) selected @endif>Lipat</option>
                        <option value="53" @if ($sepeda->tipe == 53) selected @endif>Balap</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control  @error('harga') is-invalid @enderror" id="harga" placeholder="Harga" name="harga" value="{{$sepeda->harga}}">
                </div>
                <div class="mb-3">
                    <label for="review" class="form-label">Review</label>
                    <textarea class="form-control @error('review') is-invalid @enderror" id="review" rows="5" name="review">{{$sepeda->review}}</textarea>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="checkbox">
                    <label class="form-check-label" for="flexCheckDefault">
                        Foto
                    </label>
                </div>
                <div class="mb-3" id="file">
                    <label for="formFile" class="form-label">Foto</label>
                    <input class="form-control" type="file" id="formFile" name="gambar[]" multiple>
                    <small id="emailHelp" class="form-text text-muted">Masukan Beberpa Foto</small>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mb-5">Post</button>
            </form>
        </div>
    </div>
</div>
 
@endsection

