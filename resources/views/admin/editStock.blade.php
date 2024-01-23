@extends('component/sidebar')
@section('section')

<form action='{{ url("admin/stock/$data->id/edit") }}' method='post'>
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title}}</h3>
                    {{-- <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href='/admin'>Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Stok</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="pb-3">
            </div>

            <div class="pb-3">
                <a href='{{ url("admin/stock") }}' class="btn btn-secondary">Kembali</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5 table-responsive">
                            @csrf 
                            @method('PUT')
                            <div class="mb-3 row">
                                <label for="nama_obat" class="col-sm-2 col-form-label">Nama Obat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='nama_obat' value="{{ old('nama_obat', $data->nama_obat) }}" id="nama_obat">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="satuan" id="satuan">
                                        <option value="tablet" {{ old('satuan', $data->satuan) == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                        <option value="kapsul" {{ old('satuan', $data->satuan) == 'kapsul' ? 'selected' : '' }}>Kapsul</option>
                                        <option value="botol" {{ old('satuan', $data->satuan) == 'botol' ? 'selected' : '' }}>Botol</option>
                                        <option value="tube" {{ old('satuan', $data->satuan) == 'tube' ? 'selected' : '' }}>Tube</option>
                                        <option value="pot" {{ old('satuan', $data->satuan) == 'pot' ? 'selected' : '' }}>Pot</option>
                                        <option value="sachet" {{ old('satuan', $data->satuan) == 'sachet' ? 'selected' : '' }}>Sachet</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="stok_masuk" class="col-sm-2 col-form-label">Stok Masuk</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name='stok_masuk' value="{{ old('stok_masuk', $data->stok_masuk) }}" id="stok_masuk">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="stok_keluar" class="col-sm-2 col-form-label">Stok Keluar</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name='stok_keluar' value="{{ old('stok_keluar', $data->stok_keluar) }}" id="stok_keluar">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="harga_satuan" class="col-sm-2 col-form-label">Harga Satuan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='harga_satuan' value="{{ old('harga_satuan', $data->harga_satuan) }}" id="harga_satuan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="expired_date" class="col-sm-2 col-form-label">Expired Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name='expired_date' value="{{ old('expired_date', $data->expired_date) }}" id="expired_date">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                                    <a href='{{ url("admin/stock") }}' class="btn btn-danger">Batal</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
</div>
</form>
@endsection
