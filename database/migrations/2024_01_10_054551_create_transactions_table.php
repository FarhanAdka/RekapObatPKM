<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');
            $table->string('alamat');
            $table->string('rt_rw');
            $table->unsignedBigInteger('nama_obat');
            $table->foreign('nama_obat')->references('id')->on('stock')->onDelete('cascade');
            $table->enum('satuan_jumlah', ['tablet', 'kapsul', 'botol', 'tube', 'pot', 'sachet', 'suppo']);
            $table->integer('jumlah_obat');
            $table->decimal('harga',10,2);
            $table->date('tanggal_pembelian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
