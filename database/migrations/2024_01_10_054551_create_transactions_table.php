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
            $table->unsignedBigInteger('stock_id')->constrained;
            $table->integer('jumlah_obat');
            $table->decimal('total_harga',10,2)->default(0);
            $table->date('tanggal_pelayanan');
            $table->timestamps();
            $table->foreign('stock_id')->references('id')->on('stock')->onDelete('cascade');
        });
        // Schema::create('transaction_item', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('transaction_id')->constrained;
        //     $table->unsignedBigInteger('stock_id')->constrained;
        //     $table->integer('jumlah_obat');
        //     $table->decimal('harga_subtotal', 10, 2); 
        //     $table->timestamps();
        //     $table->foreign('transaction_id')->references('id')->on('transaction')->onDelete('cascade');
        //     $table->foreign('stock_id')->references('id')->on('stock')->onDelete('cascade');
        // });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('transaction');
    }
};
