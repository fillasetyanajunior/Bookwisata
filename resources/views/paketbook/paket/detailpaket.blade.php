@extends('layouts.apputama')
@section('main')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="card">
                @php
                $foto = DB::table('paket')
                ->join('fileuploads','fileuploads.nama','=','paket.id_paket')
                ->select('fileuploads.foto')
                ->where('fileuploads.nama','=',$paket->id_paket)
                ->get();
                @endphp
                <div class="card-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @for ($i = 0; $i < count($foto); $i++) @if ($i==0) <div class="carousel-item active">
                                @else
                                <div class="carousel-item ">
                                    @endif
                                    <img src="{{asset('paket/' . $foto[$i]->foto)}}" class="d-block w-100">
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
                    <h2>Review {{$paket->nama}}</h2>
                </div>
                <div class="card-body">
                    <p>
                        {!!nl2br(str_replace("{}", " \n", $paket->review))!!}
                    </p>
                    <hr>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row">Lokasi</th>
                                <td>{{$paket->kota_search}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h1> {{$paket->nama . '/' . $paket->company}}</h1>
                    <small>{{$paket->kota_search}}</small>
                    <hr>
                    <div class="d-flex">
                        <div>
                            Price From
                        </div>
                        <div class="ml-auto">
                            <p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($paket->harga)),3)))}}</p>
                        </div>
                    </div>
                    <hr>
                    <p>{{Str::limit($paket->review, 100,'')}}</p>
                    <hr>
                    <div class="d-flex">
                        <div class="ml-auto">
                            @if ($cart->where('id',$paket->id_paket)->count())
                            <button type="button" class="btn btn-primary">In Cart</button>
                            @else
                            <form action="{{route('cartstore')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="quntity">Jumlah</label>
                                    <input type="text" class="form-control @error('quntity') is-invalid @enderror" id="quntity" name="quntity">
                                </div>
                                <input type="hidden" name="id_produk" value="{{$paket->id_paket}}">
                                <input type="hidden" name="catagori_produk" value="paket">
                                <button type="submit" class="btn btn-primary">Send In Chart</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-5">
                <h3 class="text-center my-3">Pilihan Paket Lain</h3>
                @foreach ($datapaket as $itempaket)
                    @if ($itempaket->id_paket != $paket->id_paket)
                    <div class="card-body mt-3">
                        <img src="{{asset('paket/' . $itempaket->foto)}}" alt="">
                        <h1> {{$itempaket->nama . '/' . $itempaket->company}}</h1>
                        <hr>
                        <div class="d-flex">
                            <div>
                                Harga Sewa/Hari
                            </div>
                            <div class="ml-auto">
                                <p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($itempaket->harga)),3)))}}</p>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row">Lokasi</th>
                                    <td>{{$itempaket->kota_search}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="d-flex">
                            <div class="ml-auto">
                                <a href="'/detailpaket/{{$itempaket->id}}" class="btn btn-primary">Book Now</a>
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
