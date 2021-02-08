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
        <div class="col-sm-11 mx-4">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

            <a href="{{route('create_accessmenu')}}" class="btn btn-primary my-3">Tambah Menu</a>
            <table class="table bg-info ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Nama Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($access as $Access)
                    <?php 
                    $id = $Access->id;
                    $query =  DB::table('menu')
                                ->join('access_menu','access_menu.menu_id','=','menu.id')
                                ->select('menu')
                                ->where('access_menu.id', '=' ,$id)
                                ->get();?>
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td>
                            @foreach ($query as $item)
                            {{$item->menu}}
                            @endforeach
                        </td>
                        <td>
                            @if ($Access->role_id == 1)
                                Admin
                            @elseif($Access->role_id == 2)
                                Mitra
                            @else
                                User
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-warning" href="/accessmenu/{{$Access->id}}">Edit</a>
                            <form action="/accessmenu/{{$Access->id}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('yakin');">Delete</button>
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
 
@endsection

