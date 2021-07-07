@extends('layouts.apputama')
@section('main')
 <!-- Blog Area Start -->
<div class="home-blog-area my-5">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 50rem;">
                @if ($informasi->file != null )
                <img src="{{asset('informasi/' . $informasi->file)}}" alt="">
                @else
                @endif
                <div class="card-body">
                    <h2>{{$informasi->title}}</h2>
                    <p></p>{{$informasi->informasi}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Area End -->
    
@endsection
