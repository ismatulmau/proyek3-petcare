<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grooming extends Model
{
    use HasFactory;
    protected $table = "grooming";
    protected $fillable = [
        'foto_produk','nama_produk', 'deskripsi','kategori', 'harga', 'diskon'
    ];
}
