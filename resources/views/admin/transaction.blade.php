@extends('layout.template')
@section('content')
@include('component.alert')
<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
        <form class="d-flex" action="{{url('admin/transaction')}}" method="get">
            <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
    </div>
    
    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
      <a href='/admin/transaction/create' class="btn btn-primary">+ Tambah Data</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-2">Nama Pasien</th>
                <th class="col-md-2">Alamat</th>
                <th class="col-md-1">Rt/Rw</th>
                {{-- <th class="col-md-2">Nama Obat</th>
                <th class="col-md-2">Satuan</th>
                <th class="col-md-1">Jumlah</th>
                <th class="col-md-1">Harga Satuan</th>
                <th class="col-md-1">Subtotal Harga</th> --}}
                <th class="col-md-2">Total Harga</th>
                <th class="col-md-2">Tanggal Pelayanan</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=$data->firstItem() ?>
            @foreach ($data as $item)
            <tr>
                <td>{{$i}}</td>
                <td>{{$item->nama_pasien}}</td>
                <td>{{$item->alamat}}</td>
                <td>{{$item->rt_rw}}</td>
                {{-- <td>{{$item->nama_obat}}</td>
                <td>{{$item->satuan}}</td>
                <td>{{$item->jumlah_obat}}</td>
                <td>{{$item->subtotal}}</td>
                <td>{{$item->harga_satuan}}</td>
                <td>{{$item->harga_subtotal}}</td> --}}
                <td>{{$item->total_harga}}</td>
                <td>{{$item->tanggal_pelayanan}}</td>
                <td>
                    <a href='{{url('admin/transaction/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Apakah anda yakin?')"class='d-inline' action="{{ url('admin/transaction/'.$item->id) }}" method="post">
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