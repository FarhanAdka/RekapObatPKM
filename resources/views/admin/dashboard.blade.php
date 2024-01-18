@extends('layout.template')
@section('title', 'Dashboard')
@section('content')
<form action='' method='post'>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        {{$title}} {{$role}}

        <h1>Selamat Datang, {{$name}}</h1>
        <a href='logout' class="btn btn-danger btn-sm">Logout</a>
        <a href='/admin/transaction' class="btn btn-primary btn-sm">Transaksi</a>
        <a href='/admin/stock' class="btn btn-secondary btn-sm">Stok Obat</a>

        @php
            $expiringStock = app('App\Http\Controllers\StockController')->getExpiringStock();
        @endphp

        @if(count($expiringStock) > 0)
            <div class="alert alert-warning mt-3" role="alert">
                Perhatian! Ada stok obat yang akan segera expire:
                <ul>
                    @foreach($expiringStock as $stock)
                        <li>{{$stock->nama_obat}} - Expired Date: {{$stock->expired_date}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</form>
@endsection