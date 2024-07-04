<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'orderdetails'; // Tentukan nama tabel untuk model Order

    protected $fillable = [
        'order_id',
        'KodeBarang',     // FK ke tabel users, jika aplikasi mendukung login
        'NamaBarang', // Total harga, dapat dihitung dari quantity * harga_jual
        'Kuantitas',
        'SubTotal',
        'tanggal_order' // Tanggal dan waktu pembuatan order
    ];

    public $timestamps = true; // Aktifkan timestamp untuk created_at dan updated_at

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'KodeBarang', 'KodeBarang');
    }

    // Relasi dengan User, jika ada fitur user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
