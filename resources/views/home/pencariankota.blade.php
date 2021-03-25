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
                        <span>Bookwisata | Rental Mobil</span>
                        <h3>Favourite Places</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($mobils as $mobil)
                 @php
                    $foto = DB::table('mobil')
                                ->join('fileuploads','fileuploads.nama','=','mobil.nama')
                                ->limit('1')
                                ->where('fileuploads.nama','=',$mobil->nama)
                                ->get();
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-place mb-30">
                        <div class="place-img">
                            @foreach ($foto as $foto)
                            <img src="{{asset('mobil/' . $foto->foto)}}" alt="">
                            @endforeach
                        </div>
                        <div class="place-cap">
                            <div class="place-cap-top">
                                @if ($mobil->rating)
                                    @if ($mobil->rating >= 1000)
                                        <span><i class="fas fa-star">  </i><span>4.0 Superb</span> </span>
                                    @elseif($mobil->rating >= 500)
                                        <span><i class="fas fa-star">  </i><span>3.0 Superb</span> </span>
                                    @elseif($mobil->rating >= 250)
                                        <span><i class="fas fa-star">  </i><span>2.0 Superb</span> </span>
                                    @else
                                        <span><i class="fas fa-star">  </i><span>1.0 Superb</span> </span>
                                    @endif    
                                @else
                                    <span><i class="fas fa-star">  </i><span>0.0 Superb</span> </span>
                                @endif  
                                <h3><a href="#">{{$mobil->nama}}</a></h3>
                                <p class="dolor">{{$mobil->harga}} IDR <span>/Hari</span></p>
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
                        <span>Bookwista | Bus Pariwisata</span>
                        <h3>Favourite Places</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($buss as $bus)
                @php
                    $foto = DB::table('bus')
                                ->join('fileuploads','fileuploads.nama','=','bus.nama')
                                ->limit('1')
                                ->where('fileuploads.nama','=',$bus->nama)
                                ->get();
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-place mb-30">
                        <div class="place-img">
                            @foreach ($foto as $foto)
                            <img src="{{asset('bus/' . $foto->foto)}}" alt="">
                            @endforeach
                        </div>
                        <div class="place-cap">
                            <div class="place-cap-top">
                                @if ($bus->rating)
                                @if ($bus->rating >= 1000)
                                    <span><i class="fas fa-star">  </i><span>4.0 Superb</span> </span>
                                @elseif($bus->rating >= 500)
                                    <span><i class="fas fa-star">  </i><span>3.0 Superb</span> </span>
                                @elseif($bus->rating >= 250)
                                    <span><i class="fas fa-star">  </i><span>2.0 Superb</span> </span>
                                @else
                                    <span><i class="fas fa-star">  </i><span>1.0 Superb</span> </span>
                                @endif    
                            @else
                                <span><i class="fas fa-star">  </i><span>0.0 Superb</span> </span>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <span>Bookwisata | Paket wisata</span>
                        <h3>Favourite Places</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($pakets as $paket)
               @php
                    $foto = DB::table('paket')
                                ->join('fileuploads','fileuploads.nama','=','paket.nama')
                                ->limit('1')
                                ->where('fileuploads.nama','=',$paket->nama)
                                ->get();
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-place mb-30">
                        <div class="place-img">
                            @foreach ($foto as $foto)
                            <img src="{{asset('paket/' . $foto->foto)}}" alt="">
                            @endforeach
                        </div>
                        <div class="place-cap">
                            <div class="place-cap-top">
                                    @if ($paket->rating)
                                    @if ($paket->rating >= 1000)
                                        <span><i class="fas fa-star">  </i><span>4.0 Superb</span> </span>
                                    @elseif($paket->rating >= 500)
                                        <span><i class="fas fa-star">  </i><span>3.0 Superb</span> </span>
                                    @elseif($paket->rating >= 250)
                                        <span><i class="fas fa-star">  </i><span>2.0 Superb</span> </span>
                                    @else
                                        <span><i class="fas fa-star">  </i><span>1.0 Superb</span> </span>
                                    @endif    
                                @else
                                    <span><i class="fas fa-star">  </i><span>0.0 Superb</span> </span>
                                @endif  
                                <h3><a href="#">{{$paket->nama}}</a></h3>
                                <h4>{{$paket->alamat}}</h4>
                                <p class="dolor"> {{$paket->harga}} IDR<span>/Paket</span></p>
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
                        <h3>Favourite Places</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($kapals as $kapal)
                @php
                    $foto = DB::table('kapal')
                                ->join('fileuploads','fileuploads.nama','=','kapal.nama')
                                ->limit('1')
                                ->where('fileuploads.nama','=',$kapal->nama)
                                ->get();
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-place mb-30">
                        <div class="place-img">
                            @foreach ($foto as $foto)
                            <img src="{{asset('kapal/' . $foto->foto)}}" alt="">
                            @endforeach
                        </div>
                        <div class="place-cap">
                            <div class="place-cap-top">
                                    @if ($kapal->rating)
                                    @if ($kapal->rating >= 1000)
                                        <span><i class="fas fa-star">  </i><span>4.0 Superb</span> </span>
                                    @elseif($kapal->rating >= 500)
                                        <span><i class="fas fa-star">  </i><span>3.0 Superb</span> </span>
                                    @elseif($kapal->rating >= 250)
                                        <span><i class="fas fa-star">  </i><span>2.0 Superb</span> </span>
                                    @else
                                        <span><i class="fas fa-star">  </i><span>1.0 Superb</span> </span>
                                    @endif    
                                @else
                                    <span><i class="fas fa-star">  </i><span>0.0 Superb</span> </span>
                                @endif  
                                <h3><a href="#">{{$kapal->nama}} </a></h3>
                                <h4>{{$kapal->lokasi}}</h4>
                                <p class="dolor">{{$kapal->harga}} IDR<span>/Kapal</span></p>
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
                        <h3>Favourite Places</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($hotels as $hotel)
               @php
                    $foto = DB::table('hotel')
                                ->join('fileuploads','fileuploads.nama','=','hotel.nama')
                                ->limit('1')
                                ->where('fileuploads.nama','=',$hotel->nama)
                                ->get();
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-place mb-30">
                        <div class="place-img">
                            @foreach ($foto as $foto)
                            <img src="{{asset('hotel/' . $foto->foto)}}" alt="">
                            @endforeach
                        </div>
                        <div class="place-cap">
                            <div class="place-cap-top">
                                    @if ($hotel->rating)
                                    @if ($hotel->rating >= 1000)
                                        <span><i class="fas fa-star">  </i><span>4.0 Superb</span> </span>
                                    @elseif($hotel->rating >= 500)
                                        <span><i class="fas fa-star">  </i><span>3.0 Superb</span> </span>
                                    @elseif($hotel->rating >= 250)
                                        <span><i class="fas fa-star">  </i><span>2.0 Superb</span> </span>
                                    @else
                                        <span><i class="fas fa-star">  </i><span>1.0 Superb</span> </span>
                                    @endif    
                                @else
                                    <span><i class="fas fa-star">  </i><span>0.0 Superb</span> </span>
                                @endif  
                                <h3><a href="#">{{$hotel->nama}} </a></h3>
                                <h4>{{$hotel->lokasi}}</h4>
                                <p class="dolor">{{$hotel->harga}} IDR<span>/Hari</span></p>
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
                        <h3>Favourite Places</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($guides as $guide)
                @php
                    $foto = DB::table('guide')
                                ->join('fileuploads','fileuploads.nama','=','guide.nama')
                                ->limit('1')
                                ->where('fileuploads.nama','=',$guide->nama)
                                ->get();
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-place mb-30">
                        <div class="place-img">
                            @foreach ($foto as $foto)
                            <img src="{{asset('guide/' . $foto->foto)}}" alt="">
                            @endforeach
                        </div>
                        <div class="place-cap">
                            <div class="place-cap-top">
                                    @if ($guide->rating)
                                    @if ($guide->rating >= 1000)
                                        <span><i class="fas fa-star">  </i><span>4.0 Superb</span> </span>
                                    @elseif($guide->rating >= 500)
                                        <span><i class="fas fa-star">  </i><span>3.0 Superb</span> </span>
                                    @elseif($guide->rating >= 250)
                                        <span><i class="fas fa-star">  </i><span>2.0 Superb</span> </span>
                                    @else
                                        <span><i class="fas fa-star">  </i><span>1.0 Superb</span> </span>
                                    @endif    
                                @else
                                    <span><i class="fas fa-star">  </i><span>0.0 Superb</span> </span>
                                @endif  
                                <h3><a href="#">{{$guide->nama}} </a></h3>
                                <h4>{{$guide->lokasi}}</h4>
                                <p class="dolor">{{$guide->harga}} IDR<span>/Hari</span></p>
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
                        <h3>Favourite Places</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($kuliners as $kuliner)
                @php
                    $foto = DB::table('kuliner')
                                ->join('fileuploads','fileuploads.nama','=','kuliner.nama')
                                ->limit('1')
                                ->where('fileuploads.nama','=',$kuliner->nama)
                                ->get();
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-place mb-30">
                        <div class="place-img">
                            @foreach ($foto as $foto)
                            <img src="{{asset('kuliner/' . $foto->foto)}}" alt="">
                            @endforeach
                        </div>
                        <div class="place-cap">
                            <div class="place-cap-top">
                                    @if ($kuliner->rating)
                                    @if ($kuliner->rating >= 1000)
                                        <span><i class="fas fa-star">  </i><span>4.0 Superb</span> </span>
                                    @elseif($kuliner->rating >= 500)
                                        <span><i class="fas fa-star">  </i><span>3.0 Superb</span> </span>
                                    @elseif($kuliner->rating >= 250)
                                        <span><i class="fas fa-star">  </i><span>2.0 Superb</span> </span>
                                    @else
                                        <span><i class="fas fa-star">  </i><span>1.0 Superb</span> </span>
                                    @endif    
                                @else
                                    <span><i class="fas fa-star">  </i><span>0.0 Superb</span> </span>
                                @endif  
                                <h3><a href="#">{{$kuliner->nama}}</a></h3>
                                <h4>{{$kuliner->alamat}}</h4>
                                <p class="dolor"> {{$kuliner->harga}} IDR<span>/Paket</span></p>
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
                        <h3>Favourite Places</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($destinasis as $destinasi)
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center">
                        <span>Bookwisata | Pusat oleh-oleh</span>
                        <h3>Favourite Places</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($pusats as $pusat)
                @php
                    $foto = DB::table('pusat')
                                ->join('fileuploads','fileuploads.nama','=','pusat.nama')
                                ->limit('1')
                                ->where('fileuploads.nama','=',$pusat->nama)
                                ->get();
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="single-place mb-30">
                        <div class="place-img">
                            @foreach ($foto as $foto)
                            <img src="{{asset('pusat/' . $foto->foto)}}" alt="">
                            @endforeach
                        </div>
                        <div class="place-cap">
                            <div class="place-cap-top">
                                    @if ($pusat->rating)
                                    @if ($pusat->rating >= 1000)
                                        <span><i class="fas fa-star">  </i><span>4.0 Superb</span> </span>
                                    @elseif($pusat->rating >= 500)
                                        <span><i class="fas fa-star">  </i><span>3.0 Superb</span> </span>
                                    @elseif($pusat->rating >= 250)
                                        <span><i class="fas fa-star">  </i><span>2.0 Superb</span> </span>
                                    @else
                                        <span><i class="fas fa-star">  </i><span>1.0 Superb</span> </span>
                                    @endif    
                                @else
                                    <span><i class="fas fa-star">  </i><span>0.0 Superb</span> </span>
                                @endif  
                                <h3><a href="#">{{$pusat->nama}} </a></h3>
                                <h4>{{$pusat->lokasi}}</h4>
                                <p class="dolor">{{$pusat->harga}} IDR<span>/Paket</span></p>
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
        </div>
    </div>
    <!-- Favourite Places End -->
    
@endsection
