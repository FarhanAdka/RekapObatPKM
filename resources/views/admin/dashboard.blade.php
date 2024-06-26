@extends('component/sidebar')
@section('section')
    <div id="main-content">
        <div class="page-heading">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>{{ $title }}</h3>
                        {{-- <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p> --}}
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                <li class="breadcrumb-item"><a href='/admin/profile'>Profile</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <section class="section">
                <div class="row">
                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="card">

                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <h6 class="text-small font-bold mx-6 mb-3"> Stok Segera Habis </h6>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No</th>
                                            <th class="col-md-2">Nama Obat</th>
                                            <th class="col-md-1">Stok Sisa</th>
                                            <th class="col-md-2">Expired Date</th>
                                            <th class="col-md-2 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=$data1->firstItem() ?>
                                        @foreach ($data1 as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->nama_obat}}</td>
                                            <td>{{$item->stok_sisa}}</td>
                                            <td>{{$item->expired_date}}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href='{{url('admin/stock/'.$item->id.'/add')}}' class="btn btn-primary btn-sm me-2">Tambah</a>   
                                                    <a href='{{url('admin/stock/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm ">Edit</a>
                                                </div>                    
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$data1->appends(['data1_page' => $data1->currentPage()])->links()}}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <h6 class="text-small font-bold mx-6 mb-3"> Stok Mendekati Expired </h6>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No</th>
                                            <th class="col-md-2">Nama Obat</th>
                                            <th class="col-md-1">Stok Sisa</th>
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
                                            <td>{{$item->stok_sisa}}</td>
                                            <td>{{$item->expired_date}}</td>
                                            <td>
                                                <a href='{{url('admin/stock/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>              
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$data2->appends(['data2_page' => $data2->currentPage()])->links()}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <h6 class="text-small font-bold mx-6 mb-3"> Stok Obat</h6>
                                <div class="row">
                                    <a href="/admin/stock">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2 text-center w-100 justify-content-start">
                                                <i class="bi bi-folder-fill mx-3 mb-4 "></i>
                                                <h6 class="text-white font-semibold mx-0 mb-0"> Data Stok Obat </h6>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="/admin/stock/create">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2 text-center w-100 justify-content-start">
                                                <i class="bi bi-folder-plus mx-3 mb-4 "></i>
                                                <h6 class="text-white font-semibold mx-0 mb-0"> Tambah Stok Baru </h6>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="/admin/stock/table">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2 text-center w-100 justify-content-start">
                                                <i class="bi bi-file-earmark-excel-fill mx-3 mb-4 "></i>
                                                <h6 class="text-white font-semibold mx-0 mb-0"> Export Data Stok </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <h6 class="text-small font-bold mx-6 mb-3">Transaksi</h6>
                                <div class="row">
                                    <a href="/admin/transaction">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2 text-center w-100 justify-content-start">
                                                <i class="bi bi-person-lines-fill mx-3 mb-4 "></i>
                                                <h6 class="text-white font-semibold mx-0 mb-0"> Data Transaksi </h6>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="/admin/transaction/create">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2 text-center w-100 justify-content-start">
                                                <i class="bi bi-person-fill-add mx-3 mb-4 "></i>
                                                <h6 class="text-white font-semibold mx-0 mb-0"> Tambah Transaksi Baru </h6>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="/admin/transaction/table">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2 text-center w-100 justify-content-start">
                                                <i class="bi bi-file-earmark-excel-fill mx-3 mb-4 "></i>
                                                <h6 class="text-white font-semibold mx-0 mb-0"> Export Data Transaksi </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </div>
@endsection