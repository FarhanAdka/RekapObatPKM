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

    public function transaction(){
        return $this->hasMany(Transaction::class,'transaction_item');
    }
    public static function boot()
    {
        parent::boot();

        // Event listener untuk menyimpan nilai stok_sisa sebelum menyimpan atau mengupdate model
        static::saving(function ($stock) {
            $stock->stok_sisa = $stock->stok_masuk - $stock->stok_keluar;
        });
    }

}
