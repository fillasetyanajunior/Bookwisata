@extends('layouts.apputama')
@section('main')
<div class="our-services servic-padding">
    <div class="container">
        <div class="row d-flex justify-contnet-center">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                <div class="single-services text-center mb-30">
                    <div class="services-ion">
                        <span class="flaticon-tour"></span>
                    </div>
                    <div class="services-cap">
                        <h5>8000+ Our Local<br>Guides</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                <div class="single-services text-center mb-30">
                    <div class="services-ion">
                        <span class="flaticon-pay"></span>
                    </div>
                    <div class="services-cap">
                        <h5>100% Trusted Tour<br>Agency</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                <div class="single-services text-center mb-30">
                    <div class="services-ion">
                        <span class="flaticon-experience"></span>
                    </div>
                    <div class="services-cap">
                        <h5>28+ Years of Travel<br>Experience</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                <div class="single-services text-center mb-30">
                    <div class="services-ion">
                        <span class="flaticon-good"></span>
                    </div>
                    <div class="services-cap">
                        <h5>98% Our Travelers<br>are Happy</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="favourite-place place-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwista | Bus Pariwisata</span>
                    <h3></h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($bus as $bus)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('bus/' . $bus->foto)}}" alt="">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($bus->rating)
                            @if ($bus->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($bus->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($bus->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#"> {{$bus->nama}} </a></h3>
                            <p class="dolor">{{$bus->harga}} IDR<span>/Hari</span></p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $bus->updated_at}} </li>
                            </ul>
                        </div>
                        <a href="/detailbus/{{$bus->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
