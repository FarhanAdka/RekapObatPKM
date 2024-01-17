@extends('layout.template')
@section('title', 'Data Transaksi')
@section('content')
@include('component.alert')
<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="pb-3">
        <a href='{{ url("admin") }}' class="btn btn-secondary">Kembali</a>
        <a href='{{url("/admin/transaction/export/excel")}}' class="btn btn-secondary">Export Excel</a>
    </div>
    <!-- FORM PENCARIAN -->
    <form class="d-flex" action="{{ url('admin/transaction') }}" method="get">
        <div class="mb-3 me-3 d-flex align-items-end"> <!-- Tambahkan class align-items-end -->
            <label for="keyword" class="form-label mb-0">Cari Pasien</label> <!-- Tambahkan class mb-0 -->
            <input type="search" class="form-control mb-0" id="keyword" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Masukkan kata kunci">
        </div>
    
        <div class="mb-3 me-3 d-flex align-items-end"> <!-- Tambahkan class align-items-end -->
            <label for="tanggal_pelayanan" class="form-label mb-0">Tanggal Pelayanan</label> <!-- Tambahkan class mb-0 -->
            <input type="date" class="form-control mb-0" id="tanggal_pelayanan" name="tanggal_pelayanan" value="{{ Request::get('tanggal_pelayanan') }}" placeholder="Pilih tanggal pelayanan">
        </div>
    
        <button class="btn btn-secondary" type="submit">Cari</button> <!-- Tambahkan class align-self-end -->
    </form>
    
        
    </div>
    
    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <a href="{{ url('admin/transaction/create') }}" class="btn btn-primary">+ Tambah Data</a>
    </div>
    @include('component.tableTransaction', ['data' => $data])
   
</div>
<!-- AKHIR DATA -->
@endsection