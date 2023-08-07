<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paketLaundry extends Model
{
    use HasFactory;
    protected $table = 'paket_laundries';
    protected $fillable = ['paket_kuota', 'berat', 'harga', 'cabang', 'status'];
}
