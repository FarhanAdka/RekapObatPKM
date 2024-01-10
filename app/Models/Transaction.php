<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pasien',
        'alamat',
        'rt_rw',
        'jumlah_obat',
        'harga',
        'tanggal_pembelian',
    ];

    public function stock()
    {
        return $this->belongsToMany(Stock::class, 'stock_transaction', 'transaction_id', 'stock_id')
            ->withPivot('satuan_jumlah', 'jumlah_obat')
            ->withTimestamps();
    }
}
