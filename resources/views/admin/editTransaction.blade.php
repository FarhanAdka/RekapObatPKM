@extends('layout.template')
@section('title', 'Edit Transaksi')
@section('content')
@include('component.alert')
<form action='{{ url("admin/transaction/$data->id/edit") }}' method='post'>
    @csrf 
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="pb-3">
            <a href='{{ url("admin/transaction") }}' class="btn btn-secondary">Kembali</a>
        </div>
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
            <label for="jumlah_obat" class="col-sm-2 col-form-label">Jumlah Obat</label>
            <div class="col-sm-10">
                <input type="number" step="1" class="form-control" value="{{ old('jumlah_obat', $data->jumlah_obat) }}" name='jumlah_obat' id="jumlah_obat">
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
                <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                <a href='{{ url("admin/transaction") }}' class="btn btn-danger">Batal</a>
            </div>
        </div>
    </div>
</form>

<!-- AKHIR FORM -->
@endsection