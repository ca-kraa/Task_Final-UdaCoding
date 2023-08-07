<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    use HasFactory;
    protected $table = 'satuans';
    protected $fillable = ['satuan_unit', 'deskripsi', 'status'];

    public function paket()
    {
        return $this->hasMany(paket::class);
    }
}
