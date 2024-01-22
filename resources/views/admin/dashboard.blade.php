@extends('layout.template')
@section('title', 'Dashboard')
@section('sidebar')
    @parent

    <!-- Konten Sidebar di sini -->
    <ul>
        <li><a href='/admin/transaction'>Transaksi</a></li>
        <li><a href='/admin/stock'>Stok Obat</a></li>
        <li><a href='logout'>Logout</a></li>
        <!-- ... -->
    </ul>
@endsection
@section('content')
<form action='' method='post'>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        {{$title}} {{$role}}

        <h1>Selamat Datang, {{$name}}</h1>
        <a href='logout' class="btn btn-danger btn-sm">Logout</a>
        <a href='/admin/transaction' class="btn btn-primary btn-sm">Transaksi</a>
        <a href='/admin/stock' class="btn btn-secondary btn-sm">Stok Obat</a>
    </div>
</form>
<form action='' method='post'>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
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
<form action='' method='post'>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        @php
            $outOfStock = app('App\Http\Controllers\StockController')->getOutOfStock();
        @endphp

        @if(count($outOfStock) > 0)
            <div class="alert alert-warning mt-3" role="alert">
                Perhatian! Ada stok obat yang akan habis:
                <ul>
                    @foreach($outOfStock as $stock)
                        <li>{{$stock->nama_obat}} - Stok Sisa: {{$stock->stok_sisa}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</form>
@endsection