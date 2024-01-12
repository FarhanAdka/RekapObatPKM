@extends('layout.template')
@section('content')
@include('component.alert')
<!-- START FORM -->
<form action="{{ url('/admin/stock/store') }}" method="post">
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="mb-3 row">
            <label for="nama_obat" class="col-sm-2 col-form-label">Nama Obat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ old('nama_obat') }}"name='nama_obat' id="nama_obat">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
                <select class="form-control"  name="satuan" id="satuan">
                    <option value="tablet">Tablet</option>
                    <option value="kapsul">Kapsul</option>
                    <option value="botol">Botol</option>
                    <option value="tube">Tube</option>
                    <option value="pot">Pot</option>
                    <option value="sachet">Sachet</option>
                    <option value="suppo">Suppo</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="stok_masuk" class="col-sm-2 col-form-label">Stok Masuk</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" value="{{ old('stok_masuk') }}" name='stok_masuk' id="stok_masuk">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="stok_keluar" class="col-sm-2 col-form-label">Stok Keluar</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" value="{{ old('stok_keluar') }}" name='stok_keluar' id="stok_keluar">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="harga_satuan" class="col-sm-2 col-form-label">Harga Satuan</label>
            <div class="col-sm-10">
                <input type="number" step="0.01" class="form-control" value="{{ old('harga_satuan') }}"name='harga_satuan' id="harga_satuan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="expired_date" class="col-sm-2 col-form-label">Expired Date</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" value="{{ old('expired_date') }}"name='expired_date' id="expired_date">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="submit" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
            </div>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->
@endsection