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
            <form action="{{route('store_mobil')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row">
                    <div class="col mb-3">
                        <label for="nama" class="form-label">Nama Mobil</label>
                        <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" value="{{old('nama')}}">
                    </div>
                    <div class="col mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control  @error('company') is-invalid @enderror" id="company" name="company" placeholder="company" value="{{old('company')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Provinsi</label>
                        <select class="form-select form-control  @error('provinsi') is-invalid @enderror" aria-label="Default select example" id="form_prov" name="provinsi">
                            <option selected disabled>Pilih Provinsi</option>
                            @foreach ($response as $item)
                            <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Kabupaten/Kota</label>
                        <select class="form-select form-control  @error('kabupaten') is-invalid @enderror" aria-label="Default select example" id="form_kab" disabled  name="kabupaten">
                            <option selected >Pilih Kota</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Tipe</label>
                        <select class="form-select form-control  @error('tipe') is-invalid @enderror" aria-label="Default select example" name="tipe">
                            <option value="">Pilih Tipe Bus</option>
                            <option value="21">Sedan</option>
                            <option value="22">MVP</option>
                            <option value="23">LMVP</option>
                      </select>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Transmisi</label>
                        <select class="form-select form-control  @error('transmisi') is-invalid @enderror" aria-label="Default select example" name="transmisi">
                            <option value="" >Pilih Transmii</option>
                            <option value="1">Manual</option>
                            <option value="2">Automatic</option>
                        </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">AC</label>
                        <select class="form-select form-control  @error('ac') is-invalid @enderror" aria-label="Default select example" name="ac">
                            <option value="" >Pilih Ac</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Overland</label>
                        <select class="form-select form-control  @error('overland') is-invalid @enderror" aria-label="Default select example" name="overland">
                            <option value="" >Pilih Overland</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_sit" class="form-label">Jumlah Sit</label>
                    <input type="text" class="form-control  @error('jumlah_sit') is-invalid @enderror" id="jumlah_sit" placeholder="Jumlah Sit" name="jumlah_sit" value="{{old('jumlah_sit')}}">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control  @error('harga') is-invalid @enderror" id="harga" placeholder="Harga" name="harga" value="{{old('harga')}}">
                </div>
                <div class="mb-3">
                    <label for="review" class="form-label">Review</label>
                    <textarea class="form-control @error('review') is-invalid @enderror" id="review" rows="5" name="review"></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Foto</label>
                    <input class="form-control  @error('gambar') is-invalid @enderror" type="file" id="formFile" name="gambar[]" multiple>
                    <small id="emailHelp" class="form-text text-muted">Masukan Beberpa Foto</small>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mb-5">Post</button>
            </form>
        </div>
    </div>
  </div>
 
@endsection

