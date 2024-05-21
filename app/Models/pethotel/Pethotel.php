<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pethotel extends Model
{
    protected $fillable = ['foto_produk', 'harga', 'diskon'];

    public function kategoris()
    {
        return $this->hasMany(Kategori::class);
    }
}
