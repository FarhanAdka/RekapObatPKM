@extends('layout.template')
@section('content')
@include('component.alert')
<form action='{{ url("admin/transaction/$data->id/edit") }}' method='post'>
    @csrf 
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{ url("admin/transaction") }}' class="btn btn-secondary"><< Kembali</a>
        <div class="mb-3 row">
            <label for="nama_pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama_pasien' value="{{ old('nama_pasien', $data->nama_pasien) }}" id="nama_pasien">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ old('alamat', $data->alamat) }}"name='alamat' id="alamat">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rt_rw" class="col-sm-2 col-form-label">RT/RW</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ old('rt_rw', $data->rt_rw) }}"name='rt_rw' id="rt_rw">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="total_harga" class="col-sm-2 col-form-label">Total Harga</label>
            <div class="col-sm-10">
                <input type="number" step="0.01" class="form-control" value="{{ old('total_harga', $data->total_harga) }}"name='total_harga' id="total_harga">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="tanggal_pelayanan" class="col-sm-2 col-form-label">Tanggal Pelayanan</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" value="{{ old('tanggal_pelayanan', $data->tanggal_pelayanan) }}"name='tanggal_pelayanan' id="tanggal_pelayanan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
            </div>
        </div>
    </div>
</form>

<!-- AKHIR FORM -->
@endsection