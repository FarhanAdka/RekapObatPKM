{{-- @extends('layout.template')
@section('title', 'Tambah Transaksi')
@section('content')
@include('component.alert') --}}
@extends('component/sidebar')
@section('section')
<!-- START FORM -->
<form action="{{ url('/admin/transaction/store') }}" method="post">
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
                                <li class="breadcrumb-item active" aria-current="page">Tambah Transaksi Baru</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
    
            <section class="section">
                <div class="pb-3">
                </div>
    
                <div class="pb-3">
                    <a href='{{ url("admin/transaction") }}' class="btn btn-secondary">Kembali</a>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5 table-responsive">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="nama_pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ old('nama_pasien') }}"name='nama_pasien' id="nama_pasien">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ old('alamat') }}"name='alamat' id="alamat">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="rt_rw" class="col-sm-2 col-form-label">RT/RW</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{ old('rt_rw') }}"name='rt_rw' id="rt_rw">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="stock_id" class="col-sm-2 col-form-label">Nama Obat</label>
                                    <div class="col-sm-10">
                                        <!-- Tambahkan select untuk memilih obat -->
                                        <select class="form-select" name="stock_id" id="stock_id" required>
                                            <option value="" disabled selected>Pilih Nama Obat</option>
                                            @foreach ($stocks as $stock)
                                                <option value="{{ $stock->id }}">{{ $stock->nama_obat }} ({{$stock->expired_date}}), sisa: {{$stock->stok_sisa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="jumlah_obat" class="col-sm-2 col-form-label">Jumlah Obat</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="1" class="form-control" value="{{ old('jumlah_obat') }}" name='jumlah_obat' id="jumlah_obat" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="tanggal_pelayanan" class="col-sm-2 col-form-label">Tanggal Pelayanan</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" value="{{ old('tanggal_pelayanan') }}"name='tanggal_pelayanan' id="tanggal_pelayanan">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="submit" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                                        <a href='{{ url("admin/transaction") }}' class="btn btn-danger">Batal</a>
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