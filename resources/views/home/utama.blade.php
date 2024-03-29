@extends('layouts.apputama')
@section('main')
<x-pencarian></x-pencarian>
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
                    <span>Bookwisata | Rental Mobil</span>
                    <h3>Favourite Car</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($mobil as $mobil)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('mobil/' . $mobil->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($mobil->rating)
                            @if ($mobil->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($mobil->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($mobil->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$mobil->nama}}</a></h3>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($mobil->harga)),3)))}}<span>/Hari</span>
                            </p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $mobil->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailmobil/{{$mobil->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Bus Pariwisata</span>
                    <h3>Favourite Tourist Bus</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($bus as $bus)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('bus/' . $bus->foto)}}" alt="" height="250px">
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
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($bus->harga)),3)))}}<span>/Hari</span>
                            </p>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Paket wisata</span>
                    <h3>Favourite Tour</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($paket as $paket)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('paket/' . $paket->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($paket->rating)
                            @if ($paket->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($paket->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($paket->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$paket->nama}}</a></h3>
                            <h4>{{$paket->alamat}}</h4>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($paket->harga)),3)))}}<span>/Paket</span>
                            </p>
                            <p class="dolor"></p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $paket->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailpaket/{{$paket->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Cruises</span>
                    <h3>Favourite Cruise</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($kapal as $kapal)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('kapal/' . $kapal->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($kapal->rating)
                            @if ($kapal->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($kapal->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($kapal->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$kapal->nama}} </a></h3>
                            <h4>{{$kapal->lokasi}}</h4>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($kapal->harga)),3)))}}<span>/Kapal</span>
                            </p>
                            <p class="dolor"></p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $kapal->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailkapal/{{$kapal->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Hotel/Penginapan</span>
                    <h3>Favourite Hotel</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($hotel as $hotel)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('hotel/' . $hotel->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($hotel->rating)
                            @if ($hotel->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($hotel->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($hotel->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$hotel->nama}} </a></h3>
                            <h4>{{$hotel->lokasi}}</h4>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($hotel->harga)),3)))}}<span>/Hari</span>
                            </p>
                            <p class="dolor"></p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $hotel->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailhotel/{{$hotel->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Tour Guide Indonesia</span>
                    <h3>Favourite Tour Guide</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($guide as $guide)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('guide/' . $guide->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($guide->rating)
                            @if ($guide->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($guide->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($guide->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$guide->nama}} </a></h3>
                            <h4>{{$guide->lokasi}}</h4>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($guide->harga)),3)))}}<span>/Hari</span>
                            </p>
                            <p class="dolor"></p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $guide->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailguide/{{$guide->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Kuliner</span>
                    <h3>Favourite Kuliner</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($kuliner as $kuliner)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('kuliner/' . $kuliner->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($kuliner->rating)
                            @if ($kuliner->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($kuliner->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($kuliner->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$kuliner->nama}}</a></h3>
                            <h4>{{$kuliner->alamat}}</h4>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($kuliner->harga)),3)))}}<span>/Paket</span>
                            </p>
                            <p class="dolor"></p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $kuliner->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailkuliner/{{$kuliner->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Destinasi Wisata Indonesia</span>
                    <h3>Favourite Destinasi</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($destinasi as $destinasi)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('destinasi/' . $destinasi->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($destinasi->rating)
                            @if ($destinasi->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($destinasi->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($destinasi->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$destinasi->nama}} </a></h3>
                            <h4>{{$destinasi->lokasi}}</h4>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($destinasi->harga)),3)))}}<span>/Paket</span>
                            </p>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Pusat oleh-oleh</span>
                    <h3>Favourite Shopping</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($pusat as $pusat)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('pusat/' . $pusat->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($pusat->rating)
                            @if ($pusat->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($pusat->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($pusat->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$pusat->nama}} </a></h3>
                            <h4>{{$pusat->lokasi}}</h4>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($pusat->harga)),3)))}}<span>/Paket</span>
                            </p>
                            <p class="dolor"></p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $pusat->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailpusat/{{$pusat->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Rental Sepeda motor & Gowes</span>
                    <h3>Favourite Motorbike Rental</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($sepeda as $sepeda)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('sepeda/' . $sepeda->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($sepeda->rating)
                            @if ($sepeda->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($sepeda->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($sepeda->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$sepeda->nama}} </a></h3>
                            <h4>{{$sepeda->lokasi}}</h4>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($sepeda->harga)),3)))}}<span>/Paket</span>
                            </p>
                            <p class="dolor"></p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $sepeda->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailsepeda/{{$sepeda->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Alat Camping & Outdoor</span>
                    <h3>Favourite Camping & Outdoor</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($camp as $camp)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('camp/' . $camp->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($camp->rating)
                            @if ($camp->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($camp->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($camp->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$camp->nama}} </a></h3>
                            <h4>{{$camp->lokasi}}</h4>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($camp->harga)),3)))}}<span>/Paket</span>
                            </p>
                            <p class="dolor"></p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $camp->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailcamp/{{$camp->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Perlengkapan Tour</span>
                    <h3>Favourite Tour Equipment</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($tour as $tour)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        <img src="{{asset('tour/' . $tour->foto)}}" alt="" height="250px">
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            @if ($tour->rating)
                            @if ($tour->rating >= 1000)
                            <span><i class="fas fa-star"> </i><span>4.0 Superb</span> </span>
                            @elseif($tour->rating >= 500)
                            <span><i class="fas fa-star"> </i><span>3.0 Superb</span> </span>
                            @elseif($tour->rating >= 250)
                            <span><i class="fas fa-star"> </i><span>2.0 Superb</span> </span>
                            @else
                            <span><i class="fas fa-star"> </i><span>1.0 Superb</span> </span>
                            @endif
                            @else
                            <span><i class="fas fa-star"> </i><span>0.0 Superb</span> </span>
                            @endif
                            <h3><a href="#">{{$tour->nama}} </a></h3>
                            <h4>{{$tour->lokasi}}</h4>
                            <p class="dolor">
                                {{'Rp. '.strrev(implode('.',str_split(strrev(strval($tour->harga)),3)))}}<span>/Paket</span>
                            </p>
                            <p class="dolor"></p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $tour->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailtour/{{$tour->id}}" class="btn btn-primiry mt-3">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata | Info terbaru kami</span>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($info as $info)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <div class="place-img">
                        @if ($info->file != null )
                        <img src="{{asset('informasi/' . $info->file)}}" alt="" height="250px">
                        @else
                        @endif
                    </div>
                    <div class="place-cap">
                        <div class="place-cap-top">
                            <h3><a href="#">{{$info->title}} </a></h3>
                            <p></p>{{Str::limit($info->informasi,200)}}</p>
                        </div>
                        <div class="place-cap-bottom">
                            <ul>
                                <li><i class="far fa-clock"></i>{{ $info->updated_at}}</li>
                            </ul>
                        </div>
                        <a href="/detailinformasi/{{$info->id}}" class="btn btn-primiry mt-3">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
