<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama_produk', 'deskripsi', 'foto_produk'];

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class)->withPivot('harga_final');
    }
}
