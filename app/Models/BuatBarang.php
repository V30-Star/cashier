<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuatBarang extends Model
{
    use HasFactory;

    protected $table = 'tb_buatbarang';
    protected $primaryKey = 'id_tb_buatBarang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'harga_barang',
        'stok_barang',
    ];
}
