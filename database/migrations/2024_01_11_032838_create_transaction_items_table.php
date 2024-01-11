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
        Schema::create('transaction_item', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('stock_id');
            $table->enum('satuan', ['tablet', 'kapsul', 'botol', 'tube', 'pot', 'sachet', 'suppo']);
            $table->integer('jumlah_obat');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('harga_subtotal', 10, 2); 
            $table->timestamps();
            $table->foreign('transaction_id')->references('id')->on('transaction')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stock')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_item');
    }
};
