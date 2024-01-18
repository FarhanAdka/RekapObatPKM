<?php

namespace App\Http\Controllers;

use App\Exports\ExportTransaction;
use App\Models\Transaction;
use App\Models\Stock;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $tanggalPelayanan = $request->tanggal_pelayanan;

        $query = Transaction::orderBy('tanggal_pelayanan', 'asc')->orderBy('created_at', 'asc');

        if (strlen($keyword)) {
            $query->where('nama_pasien', 'like', "%$keyword%");
        }

        if ($tanggalPelayanan) {
            $query->whereDate('tanggal_pelayanan', $tanggalPelayanan);
        }

        $data = $query->paginate(10);

        return view('admin.transaction', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stocks = Stock::orderBy('nama_obat', 'asc')->orderBy('expired_date', 'asc')->get();
        return view('admin.createTransaction', compact('stocks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'stock_id' => 'required',
            'jumlah_obat' => 'required|numeric|min:1',
            'tanggal_pelayanan' => 'required|date',
        ]);

        // Menggunakan nilai total_harga yang dihasilkan oleh getTotalHargaAttribute
        $transaction = Transaction::create([
            'nama_pasien' => $request->nama_pasien,
            'alamat' => $request->alamat,
            'rt_rw' => $request->rt_rw,
            'stock_id' => $request->stock_id,
            'jumlah_obat' => $request->jumlah_obat,
            'tanggal_pelayanan' => $request->tanggal_pelayanan
        ]);

        $stock = Stock::find($request->stock_id);
        $stock->stok_keluar += $request->jumlah_obat;
        $stock->save();

        return redirect()->route('admin.transaction.create')->with('success', 'Transaksi berhasil ditambahkan')->withInput($request->except(['_token', 'stock_id', 'jumlah_obat']));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Transaction::where('id',$id)->get()->first();
        return view('admin.editTransaction')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $request->validate([
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'jumlah_obat' => 'required|numeric|min:1',
            'tanggal_pelayanan' => 'required|date',
        ], [
            'nama_pasien.required' => 'Nama pasien wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'rt_rw.required' => 'RT/RW wajib diisi',
            'tanggal_pelayanan.required' => 'Tanggal pelayanan wajib diisi',
        ]);

        // Menggunakan nilai total_harga yang dihasilkan oleh getTotalHargaAttribute
        $transaction = Transaction::find($id);
        $transaction->nama_pasien = $request->nama_pasien;
        $transaction->alamat = $request->alamat;
        $transaction->rt_rw = $request->rt_rw;
        $transaction->jumlah_obat = $request->jumlah_obat;
        $transaction->tanggal_pelayanan = $request->tanggal_pelayanan;
        $transaction->save();

        return redirect()->route('admin.transaction.index')->with('success', 'Transaksi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transaction::where('id',$id)->delete();
        return redirect()->route('admin.transaction.index')->with('success', 'Transa berhasil dihapus');
    }
    public function table(Request $request){
        $tanggalPelayanan = $request->tanggal_pelayanan;
        $query = Transaction::orderBy('tanggal_pelayanan', 'asc')->orderBy('created_at', 'asc');

        if ($tanggalPelayanan) {
            $query->whereDate('tanggal_pelayanan', $tanggalPelayanan);
        }
        $data = $query->get();

        return view('component.tableTransaction', compact('data'));
    }
    public function exportExcel(Request $request)
    {
        $tanggalPelayanan = $request->tanggal_pelayanan;

        // Query data sesuai tanggal pelayanan yang dipilih
        $data = Transaction::orderBy('created_at', 'asc');
        if ($tanggalPelayanan) {
            $data->whereDate('tanggal_pelayanan', $tanggalPelayanan);
        }
        $data = $data->get();

        // Export data menggunakan ExportTransaction
        return Excel::download(new ExportTransaction($data), 'rekapTransaksi.xlsx');
    }
}
