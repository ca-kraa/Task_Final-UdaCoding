<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    use HasFactory;
    protected $table = 'pakets';
    protected $fillable = ['paket_kuota', 'berat', 'harga', 'satuan_unit', 'cabang', 'status'];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_unit', 'id');
    }
}
