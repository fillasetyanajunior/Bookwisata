@extends('layouts.apputama')
@section('main')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="card">
                @php
                $foto = DB::table('hotel')
                ->join('fileuploads','fileuploads.nama','=','hotel.id_hotel')
                ->select('fileuploads.foto')
                ->where('fileuploads.nama','=',$hotel->id_hotel)
                ->get();
                @endphp
                <div class="card-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @for ($i = 0; $i < count($foto); $i++) @if ($i==0) <div class="carousel-item active">
                                @else
                                <div class="carousel-item ">
                                    @endif
                                    <img src="{{asset('hotel/' . $foto[$i]->foto)}}" class="d-block w-100">
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
                    <h2>Review {{$hotel->nama}}</h2>
                </div>
                <div class="card-body">
                    <p>
                        {!!nl2br(str_replace("{}", " \n", $hotel->review))!!}
                    </p>
                    <hr>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row">Lokasi</th>
                                <td>{{$hotel->kota_search}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tipe Kamar/Room</th>
                                <td>
                                    @foreach ($tipe as $tipes)
                                        @if ($tipes->id == $hotel->tipe)
                                            {{$tipes->tipe}}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Bad</th>
                                <td>
                                    @if ($hotel->bad == 1)
                                    1
                                    @elseif ($hotel->bad == 2)
                                    2
                                    @elseif ($hotel->bad == 3)
                                    3
                                    @elseif ($hotel->bad == 4)
                                    1+Extra
                                    @elseif ($hotel->bad == 5)
                                    2+Extra
                                    @else
                                    3+Extra
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
                    <h1> {{$hotel->nama}}</h1>
                    <small>{{$hotel->kota_search}}</small>
                    <hr>
                    <div class="d-flex">
                        <div>
                            Price From
                        </div>
                        <div class="ml-auto">
                            <p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($hotel->harga)),3)))}}</p>
                        </div>
                    </div>
                    <hr>
                    <p>{{Str::limit($hotel->review, 100,'')}}</p>
                    <hr>
                    <div class="d-flex">
                        <div class="ml-auto">
                            @if ($cart->where('id',$hotel->id_hotel)->count())
                            <button type="button" class="btn btn-primary">In Cart</button>
                            @else
                            <form action="{{route('cartstore')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="quntity">Jumlah</label>
                                    <input type="text" class="form-control @error('quntity') is-invalid @enderror" id="quntity" name="quntity">
                                </div>
                                <input type="hidden" name="id_produk" value="{{$hotel->id_hotel}}">
                                <input type="hidden" name="catagori_produk" value="hotel">
                                <button type="submit" class="btn btn-primary">Send In Chart</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-5">
                <h3 class="text-center my-3">Pilihan Hotel Lain</h3>
                @foreach ($datahotel as $itemhotel)
                    @if ($itemhotel->id_hotel != $hotel->id_hotel)
                    <div class="card-body mt-3">
                        <img src="{{asset('hotel/' . $itemhotel->foto)}}" alt="">
                        <h1> {{$itemhotel->nama}}</h1>
                        <hr>
                        <div class="d-flex">
                            <div>
                                Harga Sewa/Hari
                            </div>
                            <div class="ml-auto">
                                <p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($itemhotel->harga)),3)))}}</p>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row">Lokasi</th>
                                    <td>{{$itemhotel->kota_search}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tipe Kamar/Room</th>
                                    <td>
                                        @foreach ($tipe as $tipes)
                                            @if ($tipes->id == $hotel->tipe)
                                                {{$tipes->tipe}}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah Bad</th>
                                    <td>
                                        @if ($itemhotel->bad == 1)
                                        1
                                        @elseif ($itemhotel->bad == 2)
                                        2
                                        @elseif ($itemhotel->bad == 3)
                                        3
                                        @elseif ($itemhotel->bad == 4)
                                        1+Extra
                                        @elseif ($itemhotel->bad == 5)
                                        2+Extra
                                        @else
                                        3+Extra
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="d-flex">
                            <div class="ml-auto">
                                <a href="'/detailhotel/{{$itemhotel->id}}" class="btn btn-primary">Book Now</a>
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
