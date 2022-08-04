<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $table = 'reservasi';
    protected $fillable = ['kode', 'id_user', 'id_meja', 'tanggal', 'waktu_awal', 'waktu_akhir', 'orang', 'status'];
}
