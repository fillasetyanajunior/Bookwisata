@extends('layouts.apputama')
@section('main')
 <!-- Blog Area Start -->
<div class="home-blog-area my-5">
    <div class="container">
        <blockquote class="generic-blockquote">
        <img src="{{asset('informasi/' . $informasi->file)}}" alt="">
        <h2>{{$informasi->title}}</h2>
        <pre>{{$informasi->informasi}}</pre>
    </blockquote>
    </div>
</div>
<!-- Blog Area End -->
    
@endsection
