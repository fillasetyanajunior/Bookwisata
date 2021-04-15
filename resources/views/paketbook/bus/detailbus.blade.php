@extends('layouts.apputama')
@section('main')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-center">
                <div class="card mt-3 mb-3 col-10">
                    <div class="card-header">
                        <h1> {{$bus->nama}}</h1>
                        <h3> {{$bus->po}}</h3>
                    </div>
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
                                @for ($i = 0; $i < count($foto); $i++)
                                @if ($i == 0)
                                <div class="carousel-item active">
                                @else
                                <div class="carousel-item ">
                                @endif
                                    <img src="{{asset('bus/' . $foto[$i]->foto)}}" class="d-block w-100">
                                </div>
                                @endfor
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="row mt-5">
                            <div class="col-xs-6 col-sm-6">
                                <h3>Bookwisata</h3>
                                <form action="/bookchartbus/bus/{{$bus->id}}" method="post">
                                    @csrf
                                <input type="hidden" name="hidden" value="{{$bus->user_id}}">
                                <div class="form-group">
                                    <input type="date" class="form-control mt-3" name="date">
                                </div>
                                <div>
                                    <select class="form-select my-3" name="hari">
                                        <option value="" >Pilih Berapa Hari</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div >
                                    <select class="form-select my-3" name="pesanan">
                                        <option value="" >Jumlah Pesanan</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 text-right ">
                                <h3>Harga Perhari</h3>
                                <h3>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($bus->harga)),3)))}}</h3>
                                <button type="submit" class="btn btn-primary mt-3">Booking</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="card mt-3 mb-3 col-10">
                    <div class="card-header">
                        <h2>Review {{$bus->nama}}</h2>
                    </div>
                    <div class="card-body">
                        <p>
                            {!!nl2br(str_replace("{}", " \n", $bus->review))!!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection