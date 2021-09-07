@extends('layouts.apputama')
@section('main')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="card">
                @php
                $foto = DB::table('mobil')
                ->join('fileuploads','fileuploads.nama','=','mobil.id_mobil')
                ->select('fileuploads.foto')
                ->where('fileuploads.nama','=',$mobil->id_mobil)
                ->get();
                @endphp
                <div class="card-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @for ($i = 0; $i < count($foto); $i++) @if ($i==0) <div class="carousel-item active">
                                @else
                                <div class="carousel-item ">
                                    @endif
                                    <img src="{{asset('mobil/' . $foto[$i]->foto)}}" class="d-block w-100">
                                </div>
                                @endfor
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h2>Review {{$mobil->nama}}</h2>
                </div>
                <div class="card-body">
                    <p>
                        {!!nl2br(str_replace("{}", " \n", $mobil->review))!!}
                    </p>
                    <hr>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row">Lokasi</th>
                                <td>{{$mobil->kota_search}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tipe Transport</th>
                                <td>
                                    @if($mobil->tipe == 21)
                                        Sedan
                                    @elseif($mobil->tipe == 22)
                                        MVP
                                    @else
                                        LMVP
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Seat</th>
                                <td>{{$mobil->jumlah_sit}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Transmisi</th>
                                <td>
                                    @if ($mobil->transmisi == 1)
                                    Manual
                                    @else
                                    Automatic
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Ac</th>
                                <td>
                                    @if ($mobil->ac == 1)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Overland</th>
                                <td>
                                    @if ($mobil->overland == 1)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h1> {{$mobil->nama . '/' . $mobil->company}}</h1>
                    <small>{{$mobil->kota_search}}</small>
                    <hr>
                    <div class="d-flex">
                        <div>
                            Price From
                        </div>
                        <div class="ml-auto">
                            <p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($mobil->harga)),3)))}}</p>
                        </div>
                    </div>
                    <hr>
                    <p>{{Str::limit($mobil->review, 100,'')}}</p>
                    <hr>
                    <div class="d-flex">
                        <div class="ml-auto">
                            @if ($cart->where('id',$mobil->id_mobil)->count())
                            <button type="button" class="btn btn-primary">In Cart</button>
                            @else
                            <form action="{{route('cartstore')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="quntity">Jumlah</label>
                                    <input type="text" class="form-control @error('quntity') is-invalid @enderror" id="quntity" name="quntity">
                                </div>
                                <input type="hidden" name="id_produk" value="{{$mobil->id_mobil}}">
                                <input type="hidden" name="catagori_produk" value="mobil">
                                <button type="submit" class="btn btn-primary">Send In Chart</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-5">
                <h3 class="text-center my-3">Pilihan Mobil Lain</h3>
                @foreach ($datamobil as $itemmobil)
                    @if ($itemmobil->id_mobil != $mobil->id_mobil)
                    <div class="card-body mt-3">
                        <img src="{{asset('mobil/' . $itemmobil->foto)}}" alt="">
                        <h1> {{$itemmobil->nama . '/' . $itemmobil->company}}</h1>
                        <hr>
                        <div class="d-flex">
                            <div>
                                Harga Sewa/Hari
                            </div>
                            <div class="ml-auto">
                                <p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($itemmobil->harga)),3)))}}</p>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row">Lokasi</th>
                                    <td>{{$itemmobil->kota_search}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tipe Transport</th>
                                    <td>
                                        @if($itemmobil->tipe == 21)
                                            Sedan
                                        @elseif($itemmobil->tipe == 22)
                                            MVP
                                        @else
                                            LMVP
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah Seat</th>
                                    <td>{{$itemmobil->jumlah_sit}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Transmisi</th>
                                    <td>
                                        @if ($itemmobil->transmisi == 1)
                                        Manual
                                        @else
                                        Automatic
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Ac</th>
                                    <td>
                                        @if ($itemmobil->ac == 1)
                                        Yes
                                        @else
                                        No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Overland</th>
                                    <td>
                                        @if ($itemmobil->overland == 1)
                                        Yes
                                        @else
                                        No
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="d-flex">
                            <div class="ml-auto">
                                <a href="'/detailmobil/{{$itemmobil->id}}" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
