<?php

namespace App\Http\Controllers;

use App\Exports\ExportStock;
use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admin = User::where('id', auth()->user()->id)->get()->first();
        $info = array (
            'active_home' => 'active',
            'title' => 'Data Stok Obat',
            'username' => $admin->name,

        );
        $today = Carbon::today()->toDateString();

        // Non-Expired
        $keyword=$request->keyword;
        if(strlen($keyword)){
            $data1=Stock::where('nama_obat','like',"%$keyword%")->whereDate('expired_date', '>', $today)->orderBy('nama_obat','asc')->orderBy('expired_date','asc')->paginate(10);
            $data2=Stock::where('nama_obat','like',"%$keyword%")->whereDate('expired_date', '<=', $today)->orderBy('nama_obat','asc')->orderBy('expired_date','asc')->paginate(10);
        }
        else{
            $data1=Stock::whereDate('expired_date', '>', $today)->orderBy('nama_obat','asc')->orderBy('expired_date','asc')->paginate(10);
            $data2=Stock::whereDate('expired_date', '<=', $today)->orderBy('nama_obat','asc')->orderBy('expired_date','asc')->paginate(10);
        }

        //Expired
        return view('admin.stock', $info)->with('data1',$data1)->with('data2',$data2);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = User::where('id', auth()->user()->id)->get()->first();
        $info = array (
            'active_home' => 'active',
            'title' => 'Tambah Stok Obat',
            'username' => $admin->name,

        );
        return view('admin.createStock',$info);
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
            'harga_satuan'=> 'required|numeric|min:0',
            'expired_date'=>'required',
            'scan_kk' => 'required|file|mimes:pdf|max:2048'
        ],[
            'nama_obat.required'=> 'Nama obat wajib diisi',
            'satuan.required'=> 'Satuan wajib diisi',
            'stok_masuk.required'=> 'Stok masuk wajib diisi',
            'stok_keluar.required'=> 'Stok keluar wajib diisi',
            'harga_satuan.required'=> 'Harga satuan wajib diisi',
            'harga_satuan.numeric'=> 'Harga satuan harus berupa angka',
            'harga_satuan.min'=> 'Harga satuan tidak boleh negatif',
            'expired_date.required'=> 'Expired date wajib diisi',
            'stok_masuk.numeric'=> 'Stok masuk harus berupa angka',
            'stok_masuk.min'=> 'Stok masuk tidak boleh negatif',
            'stok_keluar.min'=> 'Stok keluar tidak boleh negatif',
            'stok_keluar.numeric'=> 'Stok keluar harus berupa angka',
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
        return redirect()->route('admin.stock.create')->with('success', 'Stok berhasil ditambahkan')->withInput($request->except(['_token', 'stock_id', 'jumlah_obat']));
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
            'title' => 'Edit Stok Obat',
            'username' => $admin->name,

        );
        $data=Stock::where('id',$id)->get()->first();
        return view('admin.editStock', $info)->with('data',$data);
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
            'harga_satuan'=> 'required|numeric|min:0',
            'expired_date'=>'required'
        ],[
            'nama_obat.required'=> 'Nama obat wajib diisi',
            'satuan.required'=> 'Satuan wajib diisi',
            'stok_masuk.required'=> 'Stok masuk wajib diisi',
            'stok_keluar.required'=> 'Stok keluar wajib diisi',
            'harga_satuan.required'=> 'Harga satuan wajib diisi',
            'harga_satuan.numeric'=> 'Harga satuan harus berupa angka',
            'harga_satuan.min'=> 'Harga satuan tidak boleh negatif',
            'expired_date.required'=> 'Expired date wajib diisi',
            'stok_masuk.min'=> 'Stok masuk tidak boleh negatif',
            'stok_keluar.min'=> 'Stok keluar tidak boleh negatif',
            'stok_masuk.numeric'=> 'Stok masuk harus berupa angka',
            'stok_keluar.numeric'=> 'Stok keluar harus berupa angka',
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
        $stock = Stock::find($id);
        $stock->fill($data);
        $stock->save();
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
    public function getExpiringStock()
    {
        $today = Carbon::today()->toDateString();
        $limitDate = Carbon::now()->addMonths(3)->format('Y-m-d');
        $expiringStock = Stock::whereBetween('expired_date', [$today, $limitDate])->orderBy('expired_date', 'asc')->paginate(3, ['*'], 'expiring_page');
        return $expiringStock;
    }
    public function getOutOfStock(){
        $today = Carbon::today()->toDateString();
        $outOfStock=stock::where('stok_sisa','<=',10)->whereDate('expired_date', '>', $today)->orderBy('nama_obat','asc')->orderBy('expired_date', 'asc')->paginate(3, ['*'], 'out_of_stock_page');
        return $outOfStock;
    }

    public function table(Request $request){
        $admin = User::where('id', auth()->user()->id)->get()->first();
        $today = Carbon::today()->toDateString();
        $info = array (
            'active_home' => 'active',
            'title' => 'Export',
            'username' => $admin->name
        );
        $filterExpired = $request->has('filterExpired');
        $query = Stock::orderBy('nama_obat', 'asc')->orderBy('expired_date', 'asc');

        if ($filterExpired) {
            $query->whereDate('expired_date', '>', $today)->orderBy('nama_obat', 'asc')->orderBy('expired_date', 'asc');
        }
        $data = $query->get();

        return view('component.tableStock', $info)->with('data',$data);
    }
    public function exportExcel(Request $request)
    {
        $filterExpired = $request->has('filterExpired');
        $today = Carbon::today()->toDateString();

        // Query data sesuai tanggal pelayanan yang dipilih
        $data = Stock::orderBy('nama_obat', 'asc')->orderBy('expired_date', 'asc');
        if ($filterExpired) {
            $data->whereDate('expired_date', '>', $today)->orderBy('nama_obat', 'asc')->orderBy('expired_date', 'asc');
        }
        $data = $data->get();

        // Export data menggunakan ExportTransaction
        return Excel::download(new ExportStock($data), 'rekapStok.xlsx');
    }
    public function add(string $id)
    {
        $admin = User::where('id', auth()->user()->id)->get()->first();
        $info = array (
            'active_home' => 'active',
            'title' => 'Tambah Stok Obat',
            'username' => $admin->name,

        );
        $data=Stock::where('id',$id)->get()->first();
        return view('admin.addStock', $info)->with('data',$data);
    }
    public function storeAdd(Request $request, string $id)
    {
        $request->validate([
            'additional' => 'required|numeric|min:0',
        ], [
            'additional.required' => 'Additional value wajib diisi',
            'additional.numeric' => 'Isian harus berupa angka',
            'additional.min'=> 'Isian tidak boleh angka negatif'
        ]);

        $stock = Stock::find($id);

        // Add the additional value to the existing 'stok_masuk'
        $stock->stok_masuk += $request->additional;
        $stock->save();

        return redirect()->route('admin.stock.index')->with('success', 'Stok masuk berhasil ditambahkan');
    }

}
