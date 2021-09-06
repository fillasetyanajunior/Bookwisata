@extends('layouts.apputama')
@section('main')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="card">
                @php
                $foto = DB::table('bus')
                ->join('fileuploads','fileuploads.nama','=','bus.nama')
                ->select('fileuploads.foto')
                ->where('fileuploads.nama','=',$bus->nama)
                ->get();
                @endphp
                <div class="card-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @for ($i = 0; $i < count($foto); $i++) @if ($i==0) <div class="carousel-item active">
                                @else
                                <div class="carousel-item ">
                                    @endif
                                    <img src="{{asset('bus/' . $foto[$i]->foto)}}" class="d-block w-100">
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
                    <h2>Review {{$bus->nama}}</h2>
                </div>
                <div class="card-body">
                    <p>
                        {!!nl2br(str_replace("{}", " \n", $bus->review))!!}
                    </p>
                    <hr>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th scope="row">Lokasi</th>
                                <td>{{$bus->kota_search}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tipe Transport</th>
                                <td>
                                    @if($bus->tipe == 31)
                                    Small Bus
                                    @elseif($bus->tipe == 32)
                                    Medium Bus
                                    @else
                                    Big Bus
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Seat</th>
                                <td>{{$bus->jumlah_sit}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Transmisi</th>
                                <td>
                                    @if ($bus->transmisi == 1)
                                    Manual
                                    @else
                                    Automatic
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Ac</th>
                                <td>
                                    @if ($bus->ac == 1)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Overland</th>
                                <td>
                                    @if ($bus->overland == 1)
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
                    <h1> {{$bus->nama . '/' . $bus->po}}</h1>
                    <small>{{$bus->kota_search}}</small>
                    <hr>
                    <div class="d-flex">
                        <div>
                            Price From
                        </div>
                        <div class="ml-auto">
                            <p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($bus->harga)),3)))}}</p>
                        </div>
                    </div>
                    <hr>
                    <p>{{Str::limit($bus->review, 100,'')}}</p>
                    <hr>
                    <div class="d-flex">
                        <div class="ml-auto">
                            @if ($cart->where('id',$bus->id_bus)->count())
                            <button type="button" class="btn btn-primary">In Cart</button>
                            @else
                            <form action="{{route('cartstore')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="quntity">Jumlah</label>
                                    <input type="text" class="form-control @error('quntity') is-invalid @enderror" id="quntity" name="quntity">
                                </div>
                                <input type="hidden" name="id_produk" value="{{$bus->id_bus}}">
                                <input type="hidden" name="catagori_produk" value="bus">
                                <button type="submit" class="btn btn-primary">Send In Chart</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-5">
                <h3 class="text-center my-3">Pilihan Transportasi Lain</h3>
                @foreach ($databus as $itembus)
                    @if ($itembus->id_bus != $bus->id_bus)
                    <div class="card-body mt-3">
                        <img src="{{asset('bus/' . $itembus->foto)}}" alt="">
                        <h1> {{$itembus->nama . '/' . $itembus->po}}</h1>
                        <hr>
                        <div class="d-flex">
                            <div>
                                Harga Sewa/Hari
                            </div>
                            <div class="ml-auto">
                                <p>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($itembus->harga)),3)))}}</p>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row">Lokasi</th>
                                    <td>{{$itembus->kota_search}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tipe Transport</th>
                                    <td>
                                        @if($itembus->tipe == 31)
                                        Small Bus
                                        @elseif($itembus->tipe == 32)
                                        Medium Bus
                                        @else
                                        Big Bus
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah Seat</th>
                                    <td>{{$itembus->jumlah_sit}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Transmisi</th>
                                    <td>
                                        @if ($itembus->transmisi == 1)
                                        Manual
                                        @else
                                        Automatic
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Ac</th>
                                    <td>
                                        @if ($itembus->ac == 1)
                                        Yes
                                        @else
                                        No
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Overland</th>
                                    <td>
                                        @if ($itembus->overland == 1)
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
                                <a href="'/detailbus/{{$itembus->id}}" class="btn btn-primary">Book Now</a>
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
