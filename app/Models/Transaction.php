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
        'stock_id',
        'jumlah_obat',
        'tanggal_pelayanan'
    ];

    public function getTotalHargaAttribute()
    {
        // Mengambil data obat terkait
        $stock = $this->stock;

        // Menghitung total harga berdasarkan jumlah_obat x harga_satuan
        if ($stock) {
            return $this->jumlah_obat * $stock->harga_satuan;
        }
        return 0; // Return 0 jika obat tidak ditemukan
    }

    // public function stock()
    // {
    //     return $this->belongsToMany(Stock::class, 'transaction_item')
    //         ->withPivot('satuan', 'jumlah_obat')
    //         ->withTimestamps();
    // }
    // app/Models/Transaction.php
    // public function items()
    // {
    //     return $this->hasMany(TransactionItem::class);
    // }
    public function stock(){
        return $this->belongsTo(stock::class);
    }

    public static function boot()
    {
        parent::boot();

        // Event listener untuk menyimpan nilai total_harga sebelum menyimpan atau mengupdate model
        static::saving(function ($transaction) {
            $stock = $transaction->stock;

            // Menghitung total harga berdasarkan jumlah_obat x harga_satuan
            if ($stock) {
                $transaction->total_harga = $transaction->jumlah_obat * $stock->harga_satuan;
            }
        });
    }

}
