@extends('component/sidebar')
@section('section')
    <div id="main-content">
        <div class="page-heading">
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
                                            <th class="col-md-2">Aksi</th>
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
                                                <a href='{{url('admin/stock/'.$item->id.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>                
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        @endforeach
                                    </tbody>
                                </table>
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
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </div>
@endsection