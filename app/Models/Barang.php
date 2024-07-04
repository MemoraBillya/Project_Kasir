<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['KodeBarang', 'Nama',
    'Satuan', 'HargaBeli', 'HargaJual', 'Stok', 'Barcode'];
    protected $table = 'barang';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $primaryKey = 'KodeBarang'; // Only if KodeBarang is indeed your primary key
    public $incrementing = false; // Important if your primary key is not auto-incrementing

}
