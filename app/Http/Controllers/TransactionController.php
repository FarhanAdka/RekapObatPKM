<?php

namespace App\Http\Controllers;

use App\Exports\ExportTransaction;
use App\Models\Transaction;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admin = User::where('id', auth()->user()->id)->get()->first();
        $info = array (
            'active_home' => 'active',
            'title' => 'Data Transaksi',
            'username' => $admin->name
        );
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

        return view('admin.transaction', $info)->with('data',$data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = User::where('id', auth()->user()->id)->get()->first();
        $info = array (
            'active_home' => 'active',
            'title' => 'Tambah Transaksi',
            'username' => $admin->name
        );
        $today = Carbon::today()->toDateString();

        $stocks = Stock::where('stok_sisa', '>', 0)->whereDate('expired_date', '>', $today)->orderBy('nama_obat', 'asc')->orderBy('expired_date', 'asc')->get();
        return view('admin.createTransaction', $info)->with('stocks',$stocks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $stock = Stock::find($request->stock_id);
        $request->validate([
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'stock_id' => 'required',
            'jumlah_obat' => 'required|numeric|min:1|max:'. $stock->stok_sisa,
            'tanggal_pelayanan' => 'required|date',
        ],[

            'nama_pasien.required'=> 'Nama pasien wajib diisi',
            'alamat.required'=> 'Alamat wajib diisi',
            'rt_rw.required'=> 'RT/RW wajib diisi',
            'stock_id.required'=> 'Obat wajib diisi',
            'jumlah_obat.required'=> 'Jumlah wajib diisi',
            'tanggal_pelayanan.required'=> 'Tanggal wajib diisi',
            'jumlah_obat.min:1'=> 'Jumlah obat minimal satu',
            'jumlah_obat.max'=> 'Jumlah obat melebihi stok sisa'

        ]);
        Transaction::create([
            'nama_pasien' => $request->nama_pasien,
            'alamat' => $request->alamat,
            'rt_rw' => $request->rt_rw,
            'stock_id' => $request->stock_id,
            'jumlah_obat' => $request->jumlah_obat,
            'tanggal_pelayanan' => $request->tanggal_pelayanan
        ]);

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
        $admin = User::where('id', auth()->user()->id)->get()->first();
        $info = array (
            'active_home' => 'active',
            'title' => 'Edit Transaksi',
            'username' => $admin->name
        );
        $data=Transaction::where('id',$id)->get()->first();
        return view('admin.editTransaction', $info)->with('data',$data);
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
        $admin = User::where('id', auth()->user()->id)->get()->first();
        $info = array (
            'active_home' => 'active',
            'title' => 'Export',
            'username' => $admin->name
        );
        $tanggalPelayanan = $request->tanggal_pelayanan;
        $query = Transaction::orderBy('tanggal_pelayanan', 'asc')->orderBy('created_at', 'asc');

        if ($tanggalPelayanan) {
            $query->whereDate('tanggal_pelayanan', $tanggalPelayanan);
        }
        $data = $query->get();

        return view('component.tableTransaction', $info)->with('data',$data);
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
