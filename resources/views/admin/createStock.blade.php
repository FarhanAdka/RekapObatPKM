{{-- @extends('layout.template')
@section('title', 'Tambah Stok')
@section('content')
@include('component.alert') --}}
@extends('component/sidebar')
@section('section')
<!-- START FORM -->

<form action="{{ url('/admin/stock/store') }}" method="post">
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
                            <li class="breadcrumb-item active" aria-current="page">Tambah Stok Baru</li>
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
<!-- AKHIR FORM -->
@endsection