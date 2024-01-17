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
            <th class="col-md-2">Aksi</th>
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
            <td>
                <a href='{{ url("admin/transaction/$item->id/edit") }}' class="btn btn-warning btn-sm">Edit</a>
                <form onsubmit="return confirm('Apakah anda yakin?')" class='d-inline' action="{{ url("admin/transaction/$item->id") }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
