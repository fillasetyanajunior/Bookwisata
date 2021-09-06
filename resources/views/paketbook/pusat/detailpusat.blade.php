@extends('layouts.apputama')
@section('main')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="card">
                @php
                $foto = DB::table('pusat')
                ->join('fileuploads','fileuploads.nama','=','pusat.nama')
                ->select('fileuploads.foto')
                ->where('fileuploads.nama','=',$pusat->nama)
                ->get();
                @endphp
                <div class="card-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @for ($i = 0; $i < count($foto); $i++) @if ($i==0) <div class="carousel-item active">
                                @else
                                <div class="carousel-item ">
                                    @endif
                                    <img src="{{asset('pusat/' . $foto[$i]->foto)}}" class="d-block w-100">
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
                    <h2>Review {{$pusat->nama}}</h2>
                </div>
                <div class="card-body">
                    <p>
                        {!!nl2br(str_replace("{}", " \n", $pusat->review))!!}
                    </p>
                    <hr>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row">Lokasi</th>
                                <td>{{$pusat->kota_search}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h1> {{$pusat->nama}}</h1>
                    <small>{{$pusat->kota_search}}</small>
                    <hr>
                    <div class="d-flex">
                        <div>
                            Price From
                        </div>
                        <div class="ml-auto">
                            <p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($pusat->harga)),3)))}}</p>
                        </div>
                    </div>
                    <hr>
                    <p>{{Str::limit($pusat->review, 100,'')}}</p>
                    <hr>
                    <div class="d-flex">
                        <div class="ml-auto">
                            @if ($cart->where('id',$pusat->id_pusat)->count())
                            <button type="button" class="btn btn-primary">In Cart</button>
                            @else
                            <form action="{{route('cartstore')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="quntity">Jumlah</label>
                                    <input type="text" class="form-control @error('quntity') is-invalid @enderror" id="quntity" name="quntity">
                                </div>
                                <input type="hidden" name="id_produk" value="{{$pusat->id_pusat}}">
                                <input type="hidden" name="catagori_produk" value="pusat">
                                <button type="submit" class="btn btn-primary">Send In Chart</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-5">
                <h3 class="text-center my-3">Pilihan Pusat Oleh-Oleh Lain</h3>
                @foreach ($datapusat as $itempusat)
                    @if ($itempusat->id_pusat != $pusat->id_pusat)
                    <div class="card-body mt-3">
                        <img src="{{asset('pusat/' . $itempusat->foto)}}" alt="">
                        <h1> {{$itempusat->nama}}</h1>
                        <hr>
                        <div class="d-flex">
                            <div>
                                Harga Sewa/Hari
                            </div>
                            <div class="ml-auto">
                                <p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($itempusat->harga)),3)))}}</p>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row">Lokasi</th>
                                    <td>{{$itempusat->kota_search}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="d-flex">
                            <div class="ml-auto">
                                <a href="'/detailpusat/{{$itempusat->id}}" class="btn btn-primary">Book Now</a>
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
