<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('KodeBarang', 20)->notNull();
            $table->string('Nama', 30)->nullable();
            $table->string('Satuan', 10)->nullable();
            $table->decimal('HargaBeli', 8, 2)->nullable();
            $table->decimal('HargaJual', 8, 2)->nullable();
            $table->integer('Stok')->nullable();
            $table->string('Barcode', 14)->nullable();
            $table->timestamps();
            $table->primary('KodeBarang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
