@extends('layout.template')
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
@endsection