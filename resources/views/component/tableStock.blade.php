<div class="pb-3">
    <a href='{{ url("admin/transaction") }}' class="btn btn-secondary">Kembali</a>
</div>
<form method="GET" action="{{ url("/admin/stock/table") }}">
    <div class="mb-3">
        <label class="form-check-label">
            @php
                $filterExpired = isset($filterExpired) ? $filterExpired : false;
            @endphp
            <input type="checkbox" class="form-check-input" name="filterExpired" value="1" {{ $filterExpired ? 'checked' : '' }}>
            Tampilkan yang belum expired
        </label>
    </div>
    <button class="btn btn-secondary" type="submit">Filter</button>

    <!-- Tombol Export as Excel -->
    <a href="{{ url("/admin/stock/export/excel") }}?filterExpired={{ $filterExpired ? 1 : 0 }}" class="btn btn-success">Export as Excel</a>
</form>

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
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$item->nama_obat}}</td>
            <td>{{$item->satuan}}</td>
            <td>{{$item->stok_masuk}}</td>
            <td>{{$item->stok_keluar}}</td>
            <td>{{$item->stok_sisa}}</td>
            <td>{{$item->harga_satuan}}</td>
            <td>{{$item->expired_date}}</td>
        </tr>
        @endforeach
    </tbody>
</table>