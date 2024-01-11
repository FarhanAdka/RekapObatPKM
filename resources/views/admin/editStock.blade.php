@extends('layout.template')
@section('content')
<form action='{{ url('admin/'.$data->id.'/edit') }}' method='post'>
    @csrf 
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{ url('admin/stock') }}' class="btn btn-secondary"><< Kembali</a>
        <div class="mb-3 row">
            <label for="nama_obat" class="col-sm-2 col-form-label">Nama Obat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama_obat' value="{{ $data->nama_obat }}" id="nama_obat">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
                <select class="form-select" name="satuan" id="satuan">
                    <option value="tablet" {{ $data->satuan == 'tablet' ? 'selected' : '' }}>Tablet</option>
                    <option value="kapsul" {{ $data->satuan == 'kapsul' ? 'selected' : '' }}>Kapsul</option>
                    <option value="botol" {{ $data->satuan == 'botol' ? 'selected' : '' }}>Botol</option>
                    <option value="tube" {{ $data->satuan == 'tube' ? 'selected' : '' }}>Tube</option>
                    <option value="pot" {{ $data->satuan == 'pot' ? 'selected' : '' }}>Pot</option>
                    <option value="sachet" {{ $data->satuan == 'sachet' ? 'selected' : '' }}>Sachet</option>
                    
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="stok_masuk" class="col-sm-2 col-form-label">Stok Masuk</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='stok_masuk' value="{{ $data->stok_masuk }}" id="stok_masuk">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="stok_keluar" class="col-sm-2 col-form-label">Stok Keluar</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='stok_keluar' value="{{ $data->stok_keluar }}" id="stok_keluar">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="harga_satuan" class="col-sm-2 col-form-label">Harga Satuan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='harga_satuan' value="{{ $data->harga_satuan }}" id="harga_satuan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="expired_date" class="col-sm-2 col-form-label">Expired Date</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name='expired_date' value="{{ $data->expired_date }}" id="expired_date">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
            </div>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->
@endsection
