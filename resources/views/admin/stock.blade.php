@extends('component/sidebar')
@section('section')
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
                                <li class="breadcrumb-item active" aria-current="page">Data Stok</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <section class="section">
                <div class="pb-3">
                    <form class="d-flex" action="{{url('admin/stock')}}" method="get">
                        <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                        <button class="btn btn-secondary" type="submit">Cari</button>
                    </form>
                </div>

                <div class="pb-3">
                    <a href='/admin/stock/create' class="btn btn-primary">+ Tambah Data</a>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5 table-responsive">
                                <h6 class="text-small font-bold mx-6 mb-3"> Stok Non-Expired</h6>
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
                                        <?php $i=$data1->firstItem() ?>
                                        @foreach ($data1 as $item)
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
                                {{$data1->links()}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5 table-responsive">
                                <h6 class="text-small font-bold mx-6 mb-3"> Stok Expired</h6>
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
                                        <?php $i=$data2->firstItem() ?>
                                        @foreach ($data2 as $item)
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
                                {{$data2->links()}}
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </div>
@endsection
