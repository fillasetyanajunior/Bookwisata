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
          
            <form action="/bus/{{$bus->id}}" method="POST" enctype="multipart/form-data">
              @method('put')
              @csrf
                 <div class="row">
                    <div class="col mb-3">
                      <label for="nama" class="form-label">Nama Bus</label>
                      <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" value="{{$bus->nama}}">
                  </div>
                  <div class="col mb-3">
                      <label for="po" class="form-label">PO</label>
                      <input type="text" class="form-control  @error('po') is-invalid @enderror" id="po" name="po" placeholder="PO" value="{{$bus->po}}">
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Provinsi</label>
                    <select class="form-select form-control  @error('provinsi') is-invalid @enderror" aria-label="Default select example" id="form_prov" name="provinsi">
                      <option disabled>Pilih Provinsi</option>
                      @foreach ($response as $item)
                      <option value="{{ $item['id'] }}" @if ($item['id'] == $bus->provinsi) selected @endif>{{ $item['nama'] }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col mb-3">
                    <label class="form-label">Kabupaten/Kota</label>
                    <select class="form-select form-control  @error('kabupaten') is-invalid @enderror" datas="{{$bus->kabupaten}}" id="form_kab" disabled  name="kabupaten">
                      <option >Pilih Kota</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Tipe</label>
                        <select class="form-select form-control  @error('tipe') is-invalid @enderror" aria-label="Default select example" name="tipe">
                        <option value="">Pilih Tipe Bus</option>
                        <option value="1" @if ($bus->tipe == 1) selected @endif>Small Bus</option>
                        <option value="2" @if ($bus->tipe == 2) selected @endif>Medium Bus</option>
                        <option value="3" @if ($bus->tipe == 3) selected @endif>Big Bus</option>
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Transmisi</label>
                        <select class="form-select form-control  @error('transmisi') is-invalid @enderror" aria-label="Default select example" name="transmisi">
                        <option selected >Pilih Transmii</option>
                        <option value="1" @if ($bus->transmisi == 1) selected @endif>Manual</option>
                        <option value="2" @if ($bus->transmisi == 2) selected @endif>Automatic</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">AC</label>
                        <select class="form-select form-control  @error('ac') is-invalid @enderror" aria-label="Default select example" name="ac">
                        <option selected >Pilih Ac</option>
                        <option value="1" @if ($bus->ac == 1) selected @endif>Ya</option>
                        <option value="2" @if ($bus->ac == 2) selected @endif>Tidak</option>
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Overland</label>
                        <select class="form-select form-control  @error('overland') is-invalid @enderror" aria-label="Default select example" name="overland">
                        <option selected >Pilih Overland</option>
                        <option value="1" @if ($bus->overland == 1) selected @endif>Ya</option>
                        <option value="2" @if ($bus->overland == 2) selected @endif>Tidak</option>
                        </select>
                    </div>
                    </div>
                <div class="mb-3">
                    <label for="jumlah_sit" class="form-label">Jumlah Sit</label>
                    <input type="text" class="form-control  @error('jumlah_sit') is-invalid @enderror" id="jumlah_sit" placeholder="Jumlah Sit" name="jumlah_sit" value="{{$bus->jumlah_sit}}">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control  @error('harga') is-invalid @enderror" id="harga" placeholder="Harga" name="harga" value="{{$bus->harga}}">
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
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Post</button>
            </form>
        </div>
    </div>
  </div>
 
@endsection

