<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = [
        'nama_pasien',
        'alamat',
        'rt_rw',
        'harga_total',
        'tanggal_pelayanan',
    ];

    public function stock()
    {
        return $this->belongsToMany(Stock::class, 'transaction_item')
            ->withPivot('satuan', 'jumlah_obat')
            ->withTimestamps();
    }
}
