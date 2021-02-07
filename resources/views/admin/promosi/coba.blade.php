@extends('layouts.appdashboard')

@section('title')

@section('main')
    
<x-slidebar></x-slidebar>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="d-flex justify-content-center">
        <div class="col-sm-11 mx-4">
          
            <form action="{{route('store_bus')}}" method="POST" enctype="multipart/form-data">
              @csrf
                 <div class="row">
                    <div class="col mb-3">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                  </div>
                  <div class="col mb-3">
                      <label for="po" class="form-label">PO</label>
                      <input type="text" class="form-control" id="po" name="po" placeholder="PO">
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Provinsi</label>
                    <select class="form-select form-control" aria-label="Default select example" id="form_prov" name="provinsi">
                      <option selected disabled>Pilih Provinsi</option>
                      @foreach ($response as $item)
                      <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col mb-3">
                    <label class="form-label">Kabupaten/Kota</label>
                    <select class="form-select form-control" aria-label="Default select example" id="form_kab" disabled  name="kabupaten">
                      <option selected >Pilih Kota</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Tipe</label>
                    <select class="form-select form-control" aria-label="Default select example" name="tipe">
                      <option selected >Pilih Provinsi</option>
                    </select>
                  </div>
                  <div class="col mb-3">
                    <label class="form-label">Transmisi</label>
                    <select class="form-select form-control" aria-label="Default select example" name="transmisi">
                      <option selected >Pilih Kota</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">AC</label>
                    <select class="form-select form-control" aria-label="Default select example" name="ac">
                      <option selected >Pilih Provinsi</option>
                    </select>
                  </div>
                  <div class="col mb-3">
                    <label class="form-label">Overland</label>
                    <select class="form-select form-control" aria-label="Default select example" name="overland">
                      <option selected >Pilih Kota</option>
                    </select>
                  </div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_sit" class="form-label">Jumlah Sit</label>
                    <input type="text" class="form-control" id="jumlah_sit" placeholder="Jumlah Sit" name="jumlah_sit">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" placeholder="Harga" name="harga">
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label">Foto</label>
                  <input class="form-control" type="file" id="formFile" name="gambar[]" multiple>
                </div>
                <button type="submit" name="submit">Post</button>
            </form>
        </div>
    </div>
  </div>
 
@endsection

