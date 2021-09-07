@extends('layouts.apputama')
@section('main')
<div class="container mb-5">
    <h1 class="mb-5">Bookwisata | Keranjang</h1>
    <hr>
    <div class="d-flex justify-content-end mb-5">
        @if ($cart->count() > 0)
        <a href="{{route('checkout')}}" class="btn btn-primary">Checkout</a>
        <form action="/cartproduk/deleteall" method="post" class="d-inline ml-3">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Hapus Semua</button>
        </form>
        @endif
    </div>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col" width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->qty}}</td>
                <td>{{'Rp. '.strrev(implode('.',str_split(strrev(strval($item->price)),3)))}}</td>
                <td>
                    <form action="/cartproduk/delete/{{$item->rowId}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <div class="d-flex align-items-center">
                    Total ({{Cart::count()}} Produk) :
                    Rp. {{Cart::priceTotal()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
