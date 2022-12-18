<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_iks_tipe extends Model
{
    use HasFactory;
    protected $table='m_iks_tipe';
    protected $fillable=['kode', 'nama', 'status_aktif'];
}
