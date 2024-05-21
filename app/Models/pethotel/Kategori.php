<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama', 'harga', 'diskon', 'total_harga'];

    public function pethotel()
    {
        return $this->belongsTo(Pethotel::class);
    }
}
