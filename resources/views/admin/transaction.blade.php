@extends('layout.template')
@section('title', 'Data Transaksi')
@section('content')
@include('component.alert')
<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
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

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-2">Nama Pasien</th>
                <th class="col-md-2">Alamat</th>
                <th class="col-md-1">Rt/Rw</th>
                <th class="col-md-2">Nama Obat</th>
                <th class="col-md-1">Jumlah Obat</th>
                <th class="col-md-1">Total Harga</th>
                <th class="col-md-2">Tanggal Pelayanan</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $data->firstItem() ?>
            @foreach ($data as $item)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $item->nama_pasien }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->rt_rw }}</td>
                <td>{{ $item->stock->nama_obat }}</td>
                <td>{{ $item->jumlah_obat }}</td>
                <td>{{ $item->total_harga }}</td>
                <td>{{ $item->tanggal_pelayanan }}</td>
                <td>
                    <a href='{{ url("admin/transaction/$item->id/edit") }}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Apakah anda yakin?')" class='d-inline' action="{{ url("admin/transaction/$item->id") }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                    </form>
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
   
</div>
<!-- AKHIR DATA -->
@endsection