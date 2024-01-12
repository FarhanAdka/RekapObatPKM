<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword=$request->keyword;
        if(strlen($keyword)){
            $data=Stock::where('nama_obat','like',"%$keyword%")->orderBy('nama_obat','asc')->orderBy('expired_date','asc')->paginate(10);
            // ->orWhere('nama_obat','like',"%keyword%")
        }
        else{
            $data=Stock::orderBy('nama_obat','asc')->orderBy('expired_date','asc')->paginate(10);
        }
        return view('admin.stock')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createStock');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat'=> 'required',
            'satuan'=> 'required',
            'stok_masuk'=> 'required|numeric|min:0',
            'stok_keluar'=> 'required|numeric|min:0|max:'. $request->stok_masuk,
            'harga_satuan'=> 'required',
            'expired_date'=>'required'
        ],[
            'nama_obat.required'=> 'Nama obat wajib diisi',
            'satuan.required'=> 'Satuan wajib diisi',
            'stok_masuk.required'=> 'Stok masuk wajib diisi',
            'stok_keluar.required'=> 'Stok keluar wajib diisi',
            'harga_satuan.required'=> 'Harga satuan wajib diisi',
            'expired_date.required'=> 'Expired date wajib diisi',
            'stok_masuk.numeric'=> 'Isian harus berupa angka',
            'stok_keluar.numeric'=> 'Isian harus berupa angka',
            'stok_keluar.max' => 'Stok keluar tidak boleh melebihi stok masuk'
        ]);
        $data=[
            'nama_obat'=>$request->nama_obat,
            'satuan'=>$request->satuan,
            'stok_masuk'=>$request->stok_masuk,
            'stok_keluar'=>$request->stok_keluar,
            'harga_satuan'=>$request->harga_satuan,
            'expired_date'=>$request->expired_date
        ];
        Stock::create($data);
        return redirect()->route('admin.stock.index')->with('success', 'Stok berhasil ditambahkan');
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
        $data=Stock::where('id',$id)->get()->first();
        return view('admin.editStock')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_obat'=> 'required',
            'satuan'=> 'required',
            'stok_masuk'=> 'required|numeric|min:0',
            'stok_keluar'=> 'required|numeric|min:0|max:'. $request->stok_masuk,
            'harga_satuan'=> 'required',
            'expired_date'=>'required'
        ],[
            'nama_obat.required'=> 'Nama obat wajib diisi',
            'satuan.required'=> 'Satuan wajib diisi',
            'stok_masuk.required'=> 'Stok masuk wajib diisi',
            'stok_keluar.required'=> 'Stok keluar wajib diisi',
            'harga_satuan.required'=> 'Harga satuan wajib diisi',
            'expired_date.required'=> 'Expired date wajib diisi',
            'stok_masuk.numeric'=> 'Isian harus berupa angka',
            'stok_keluar.numeric'=> 'Isian harus berupa angka',
            'stok_keluar.max' => 'Stok keluar tidak boleh melebihi stok masuk'
        ]);
        $data=[
            'nama_obat'=>$request->nama_obat,
            'satuan'=>$request->satuan,
            'stok_masuk'=>$request->stok_masuk,
            'stok_keluar'=>$request->stok_keluar,
            'harga_satuan'=>$request->harga_satuan,
            'expired_date'=>$request->expired_date
        ];
        Stock::where('id',$id)->update($data);
        return redirect()->route('admin.stock.index')->with('success', 'Stok berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        stock::where('id',$id)->delete();
        return redirect()->route('admin.stock.index')->with('success', 'Stok berhasil dihapus');
    }
}
