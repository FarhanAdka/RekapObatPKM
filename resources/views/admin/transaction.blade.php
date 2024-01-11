@extends('layout.template')
@section('content')
<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
      <form class="d-flex" action="" method="get">
          <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
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
                <th class="col-md-2">Nama Obat</th>
                <th class="col-md-2">Satuan</th>
                <th class="col-md-1">Jumlah</th>
                <th class="col-md-2">Harga</th>
                <th class="col-md-2">Tanggal Pelayanan</th>
                <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Supardi</td>
                <td>Wanareja</td>
                <td>01/01</td>
                <td>Amoksisilin</td>
                <td>Sachet</td>
                <td>1</td>
                <td>10.000</td>
                <td>01/01/23</td>
                <td>
                    <a href='' class="btn btn-warning btn-sm">Edit</a>
                    <a href='' class="btn btn-danger btn-sm">Del</a>
                </td>
            </tr>
        </tbody>
    </table>
   
</div>
<!-- AKHIR DATA -->
@endsection