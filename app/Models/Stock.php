<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;
    protected $table = 'stock';
    protected $fillable = [
        'nama_obat',
        'satuan',
        'stok_masuk',
        'stok_keluar',
        'harga_satuan',
        'expired_date'
    ];
    public function getStokSisaAttribute()
    {
        return $this->stok_masuk - $this->stok_keluar;
    }

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_item')
            ->withPivot('satuan_jumlah', 'jumlah_obat')
            ->withTimestamps();
    }
}
