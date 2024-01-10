<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_obat',
        'satuan_jumlah',
        'jumlah',
        'expired_date',
    ];

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class, 'stock_transaction', 'stock_id', 'transaction_id')
            ->withPivot('satuan_jumlah', 'jumlah_obat')
            ->withTimestamps();
    }
}
