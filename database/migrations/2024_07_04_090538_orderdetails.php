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
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id(); // Primary key
            // $table->string('kode_barang'); // Foreign key ke tabel barang
            // $table->foreign('kode_barang')->references('KodeBarang')->on('barang');
            $table->string('order_id', 20)->nullable();
            $table->string('KodeBarang', 20)->nullable();
            $table->string('NamaBarang', 30)->nullable();
            $table->integer('Kuantitas')->nullable();
            $table->decimal('SubTotal', 8, 2)->nullable();
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
        Schema::dropIfExists('orderdetails');
    }
};
