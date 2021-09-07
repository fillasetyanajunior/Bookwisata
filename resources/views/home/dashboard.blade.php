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
                        <li class="breadcrumb-item"><a href="#">Utama</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($informasi as $informasi)
                <div class="col-lg-3 col-6">
                    <div class="card" style="width: 18rem;">
                        @if ($informasi->file != null )
                        <img src="{{asset('informasi/' . $informasi->file)}}" alt="" class="card-img-top">
                        @else
                        @endif
                        <div class="card-body">
                            <h4>{{$informasi->title}}</h4>
                            <p>{{$informasi->informasi}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

@endsection
