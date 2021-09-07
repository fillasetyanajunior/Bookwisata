@extends('layouts.apputama')
@section('main')
<div class="home-blog-area my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Bookwisata</span>
                    <h3>Layanan Mitra</h3>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <center>
                        <div class="card text-white  mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-success">
                                <h3>Trial Mitra</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Trial Mitra 30 Hari</h4>
                                <p class="card-text" style="color: white">Trial</p>
                                <p class="card-text">0</p>
                                <form action="/layananmitra" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="5">
                                    <input type="hidden" name="harga" value="0">
                                    <button type="submit" class="btn btn-primary">Pilih Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <center>
                        <div class="card text-white  mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-success">
                                <h3>Termurah</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Layanan 3 Bulan</h4>
                                <p class="card-text" style="color: white">pemula</p>
                                <p class="card-text">150.000.-/3 Bulan</p>
                                <form action="/layananmitra" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="1">
                                    <input type="hidden" name="harga" value="150000">
                                    <button type="submit" class="btn btn-primary">Pilih Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <center>
                        <div class="card text-white  mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-success">
                                <h3>Diskon 30%</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Layanan 6 Bulan</h4>
                                <p class="card-text"><s>400.000.-</s></p>
                                <p class="card-text">280.000.-/6 Bulan</p>
                                <form action="/layananmitra" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="2">
                                    <input type="hidden" name="harga" value="280000">
                                    <button type="submit" class="btn btn-primary">Pilih Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <center>
                        <div class="card text-white  mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-success">
                                <h3>Diskon 75%</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Layanan 2 Tahun</h4>
                                <p class="card-text"><s>1.000.000.-</s></p>
                                <p class="card-text">750.000.-/6 Bulan</p>
                                <form action="/layananmitra" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="3">
                                    <input type="hidden" name="harga" value="750000">
                                    <button type="submit" class="btn btn-primary">Pilih Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-place mb-30">
                    <center>
                        <div class="card text-white  mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-success">
                                <h3>Diskon 50%</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Layanan 1 Tahun</h4>
                                <p class="card-text"><s>1.000.000.-</s></p>
                                <p class="card-text">500.000.-/Bln</p>
                                <form action="/layananmitra" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="4">
                                    <input type="hidden" name="harga" value="500000">
                                    <button type="submit" class="btn btn-primary">Pilih Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
