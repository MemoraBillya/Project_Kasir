<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            // $table->string('kode_barang'); // Foreign key ke tabel barang
            // $table->foreign('kode_barang')->references('KodeBarang')->on('barang');
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key ke tabel users, opsional
            $table->foreign('user_id')->references('id')->on('users');
            // $table->integer('quantity');
            // $table->decimal('harga_jual', 8, 2);
            $table->decimal('total_harga', 10, 2);
            $table->timestamp('tanggal_order')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
