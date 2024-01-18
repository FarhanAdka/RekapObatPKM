@extends('layout.template')
@section('title', 'Data Stok')
@section('content')
@include('component.alert')
<!-- START DATA -->
<div class="pb-3" style="text-align: center;"><span style="color: #000080;"><strong>DATA STOK OBAT</strong></span></div>
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="pb-3">
        <a href='{{ url("admin") }}' class="btn btn-secondary">Kembali</a>
    </div>
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
        <form class="d-flex" action="{{url('admin/stock')}}" method="get">
            <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
    </div>
                
    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <a href='/admin/stock/create' class="btn btn-primary">+ Tambah Data</a>
    </div>
          
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-2">Nama Obat</th>
                <th class="col-md-2">Satuan</th>
                <th class="col-md-1">Stok Masuk</th>
                <th class="col-md-1">Stok Keluar</th>
                <th class="col-md-1">Stok Sisa</th>
                <th class="col-md-2">Harga Satuan</th>
                <th class="col-md-2">Expired Date</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=$data->firstItem() ?>
            @foreach ($data as $item)
            <tr>
                <td>{{$i}}</td>
                <td>{{$item->nama_obat}}</td>
                <td>{{$item->satuan}}</td>
                <td>{{$item->stok_masuk}}</td>
                <td>{{$item->stok_keluar}}</td>
                <td>{{$item->stok_sisa}}</td>
                <td>{{$item->harga_satuan}}</td>
                <td>{{$item->expired_date}}</td>
                <td>
                    <a href='{{url('admin/stock/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Apakah anda yakin?')"class='d-inline' action="{{ url('admin/stock/'.$item->id) }}" method="post">
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
    {{$data->links()}}
               
</div>
<!-- AKHIR DATA -->
@endsection