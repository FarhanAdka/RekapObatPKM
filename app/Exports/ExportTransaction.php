<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportTransaction implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('component.tableTransaction', ['data' => $this->data]);
    }
}
// class ExportTransaction implements FromCollection{
//     // @return \Illuminate\Support\Collection
//     public function collection(){
//         $data=Transaction::orderBy('created_at','asc')->get();
//         return $data;
//     }
// }