<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword=$request->keyword;
        if(strlen($keyword)){
            $data=Transaction::where('nama_pasien','like',"%$keyword%")->orderBy('nama_pasien','asc')->orderBy('tanggal_pelayanan','asc')->paginate(10);
            // ->orWhere('nama_obat','like',"%keyword%")
        }
        else{
            $data=Transaction::orderBy('nama_pasien','asc')->orderBy('tanggal_pelayanan','asc')->paginate(10);
        }
        return view('admin.transaction')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createTransaction');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien'=> 'required',
            'alamat'=> 'required',
            'rt_rw'=> 'required',
            // 'nama_obat'=> 'required',
            // 'satuan'=> 'required',
            // 'jumlah_obat'=> 'required|numeric|min:1',
            // 'harga_satuan'=> 'required',
            // 'harga_subtotal'=> 'required',
            'total_harga'=> 'required',
            'tanggal_pelayanan'=>'required'
        ],[
            'nama_pasien.required'=> 'Nama pasien wajib diisi',
            'alamat.required'=> 'Alamat wajib diisi',
            'rt_rw.required'=> 'RT/RW wajib diisi',
            // 'nama_obat.required'=> 'Nama obat wajib diisi',
            // 'satuan.required'=> 'Satuan wajib diisi',
            // 'jumlah_obat.required'=> 'Jumlah obat wajib diisi',
            // 'harga_satuan.required'=> 'Harga satuan wajib diisi',
            // 'harga_subtotal.required'=> 'Subtotal harga satuan wajib diisi',
            'total_harga.required'=> 'Total harga wajib diisi',
            'tanggal_pelayanan.required'=> 'Tanggal pelayanan wajib diisi',
            // 'jumlah_obat.numeric'=> 'Isian harus berupa angka',
            // 'stok_keluar.max' => 'Stok keluar tidak boleh melebihi stok masuk'
        ]);
        $data=[
            'nama_pasien'=>$request->nama_pasien,
            'alamat'=>$request->alamat,
            'rt_rw'=>$request->rt_rw,
            'total_harga'=>$request->total_harga,
            'tanggal_pelayanan'=>$request->tanggal_pelayanan
        ];
        Transaction::create($data);
        return redirect()->route('admin.transaction.index')->with('success', 'Transaksi berhasil ditambahkan');
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pasien'=> 'required',
            'alamat'=> 'required',
            'rt_rw'=> 'required',
            // 'nama_obat'=> 'required',
            // 'satuan'=> 'required',
            // 'jumlah_obat'=> 'required|numeric|min:1',
            // 'harga_satuan'=> 'required',
            // 'harga_subtotal'=> 'required',
            'total_harga'=> 'required',
            'tanggal_pelayanan'=>'required'
        ],[
            'nama_pasien.required'=> 'Nama pasien wajib diisi',
            'alamat.required'=> 'Alamat wajib diisi',
            'rt_rw.required'=> 'RT/RW wajib diisi',
            // 'nama_obat.required'=> 'Nama obat wajib diisi',
            // 'satuan.required'=> 'Satuan wajib diisi',
            // 'jumlah_obat.required'=> 'Jumlah obat wajib diisi',
            // 'harga_satuan.required'=> 'Harga satuan wajib diisi',
            // 'harga_subtotal.required'=> 'Subtotal harga satuan wajib diisi',
            'total_harga.required'=> 'Total harga wajib diisi',
            'tanggal_pelayanan.required'=> 'Tanggal pelayanan wajib diisi',
            // 'jumlah_obat.numeric'=> 'Isian harus berupa angka',
            // 'stok_keluar.max' => 'Stok keluar tidak boleh melebihi stok masuk'
        ]);
        $data=[
            'nama_pasien'=>$request->nama_pasien,
            'alamat'=>$request->alamat,
            'rt_rw'=>$request->rt_rw,
            'total_harga'=>$request->total_harga,
            'tanggal_pelayanan'=>$request->tanggal_pelayanan
        ];
        Transaction::where('id',$id)->update($data);
        return redirect()->route('admin.transaction.index')->with('success', 'Transaksi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transaction::where('id',$id)->delete();
        return redirect()->route('admin.transaction.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
