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
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="d-flex justify-content-center">
        <div class="col-sm-11 mx-4 my-4">
            <form action="{{route('store_submenu')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="menu" class="form-label">Nama Menu</label>
                    <select class="form-select form-control" aria-label="Default select example" id="menu" name="menu_id">
                        <option selected>Select menu</option>
                        @foreach ($menu as $item)
                            <option value="{{$item->id}}">{{$item->menu}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sub_menu" class="form-label">Nama Sub Menu</label>
                    <input type="text" class="form-control" id="sub_menu" name="sub_menu">
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" class="form-control" id="icon" name="icon">
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" class="form-control" id="url" name="url">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Sumbit</button>
            </form>
        </div>
    </div>
  </div>
 
@endsection

