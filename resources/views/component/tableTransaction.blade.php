<div class="pb-3">
    <a href='{{ url("admin/transaction") }}' class="btn btn-secondary">Kembali</a>
</div>
<form method="GET" action="{{ url("/admin/transaction/table") }}">
    <div class="mb-3">
        <label for="tanggal_pelayanan" class="form-label">Filter Tanggal Pelayanan:</label>
        <input type="date" class="form-control" id="tanggal_pelayanan" name="tanggal_pelayanan" value="{{ Request::get('tanggal_pelayanan') }}" placeholder="Pilih tanggal pelayanan">
    </div>
    <button class="btn btn-secondary" type="submit">Filter</button>

    <!-- Tombol Export as Excel -->
    <a href="{{url("/admin/transaction/export/excel")}}?tanggal_pelayanan={{ Request::get('tanggal_pelayanan') }}" class="btn btn-success">Export as Excel</a>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-md-1">No</th>
            <th class="col-md-2">Nama Pasien</th>
            <th class="col-md-2">Alamat</th>
            <th class="col-md-1">Rt/Rw</th>
            <th class="col-md-2">Nama Obat</th>
            <th class="col-md-1">Jumlah Obat</th>
            <th class="col-md-1">Total Harga</th>
            <th class="col-md-2">Tanggal Pelayanan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_pasien }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->rt_rw }}</td>
            <td>{{ $item->stock->nama_obat }}</td>
            <td>{{ $item->jumlah_obat }}</td>
            <td>{{ $item->total_harga }}</td>
            <td>{{ $item->tanggal_pelayanan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
