<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;
    protected $table = 'transactionItem';
    protected $fillable = [
        'transaction_id', 
        'stock_id', 
        'satuan', 
        'jumlah_obat',
        'harga_satuan'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->jumlah_obat * $this->harga_satuan;
    }
}
