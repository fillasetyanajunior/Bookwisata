@extends('layouts.apputama')
@section('main')
 <!-- Our Services Start -->
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
         <!-- Our Services End -->
        <!-- Favourite Places Start -->
        <div class="favourite-place place-padding">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>Bookwisata | Destinasi Wisata Indonesia</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($destinasi as $destinasi)
                    @php
                        $foto = DB::table('destinasi')
                                    ->join('fileuploads','fileuploads.nama','=','destinasi.nama')
                                    ->limit('1')
                                    ->where('fileuploads.nama','=',$destinasi->nama)
                                    ->get();
                    @endphp
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-place mb-30">
                            <div class="place-img">
                                @foreach ($foto as $foto)
                                <img src="{{asset('destinasi/' . $foto->foto)}}" alt="">
                                @endforeach
                            </div>
                            <div class="place-cap">
                                <div class="place-cap-top">
                                        @if ($destinasi->rating)
                                        @if ($destinasi->rating >= 1000)
                                            <span><i class="fas fa-star">  </i><span>4.0 Superb</span> </span>
                                        @elseif($destinasi->rating >= 500)
                                            <span><i class="fas fa-star">  </i><span>3.0 Superb</span> </span>
                                        @elseif($destinasi->rating >= 250)
                                            <span><i class="fas fa-star">  </i><span>2.0 Superb</span> </span>
                                        @else
                                            <span><i class="fas fa-star">  </i><span>1.0 Superb</span> </span>
                                        @endif    
                                    @else
                                        <span><i class="fas fa-star">  </i><span>0.0 Superb</span> </span>
                                    @endif  
                                    <h3><a href="#">{{$destinasi->nama}} </a></h3>
                                    <h4>{{$destinasi->lokasi}}</h4>
                                    <p class="dolor">{{$destinasi->harga}} IDR<span>/Paket</span></p>
                                    <p class="dolor"></p>
                                </div>
                                <div class="place-cap-bottom">
                                    <ul>
                                        <li><i class="far fa-clock"></i>{{ $destinasi->updated_at}}</li>
                                    </ul>
                                </div>
                                <a href="/detaildestinasi/{{$destinasi->id}}" class="btn btn-primiry mt-3">Detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Favourite Places End -->
@endsection
