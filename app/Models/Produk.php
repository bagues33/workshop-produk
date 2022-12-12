<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'jumlah_produk'
    ];

    public function kategori_produks() {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }
}
