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
            
                <form action="/hotel/{{$hotel->id}}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Hotel</label>
                        <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" value="{{$hotel->nama}}">
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Provinsi</label>
                            <select class="form-select form-control  @error('provinsi') is-invalid @enderror" aria-label="Default select example" id="form_prov" name="provinsi">
                                <option disabled>Pilih Provinsi</option>
                                @foreach ($response as $item)
                                <option value="{{ $item['id'] }}" @if ($item['id'] == $hotel->provinsi) selected @endif>{{ $item['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Kabupaten/Kota</label>
                            <select class="form-select form-control  @error('kabupaten') is-invalid @enderror" datas="{{$hotel->kabupaten}}" id="form_kab" disabled  name="kabupaten">
                                <option >Pilih Kota</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Tipe Kamar</label>
                            <select class="form-select form-control  @error('tipe') is-invalid @enderror" aria-label="Default select example" name="tipe">
                                <option value="">Pilih Tipe Kamar</option>
                                @foreach ($tipe as $item)
                                <option value="{{$item->id}}" @if ($item->id == $hotel->tipe) selected @endif>{{$item->tipe}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Jumlah Bad</label>
                            <select class="form-select form-control  @error('bad') is-invalid @enderror" aria-label="Default select example" name="bad">
                                <option value="">Pilih Jumlah Bad</option>
                                <option value="1" @if ($hotel->bad == 1) selected @endif>1</option>
                                <option value="2" @if ($hotel->bad == 2) selected @endif>2</option>
                                <option value="3" @if ($hotel->bad == 3) selected @endif>3</option>
                                <option value="4" @if ($hotel->bad == 4) selected @endif>1+Extra</option>
                                <option value="5" @if ($hotel->bad == 5) selected @endif>2+Extra</option>
                                <option value="6" @if ($hotel->bad == 6) selected @endif>3+Extra</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Review</label>
                        <textarea class="form-control @error('review') is-invalid @enderror" id="review" rows="5" name="review">{{$hotel->review}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control  @error('harga') is-invalid @enderror" id="harga" placeholder="Harga" name="harga" value="{{$hotel->harga}}">
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

