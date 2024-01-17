<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportTransaction implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view():View
    {
        $data = Transaction::orderBy('created_at', 'asc')->get();
        return view('component.tableTransaction',['data' => $data]);
    }
}
