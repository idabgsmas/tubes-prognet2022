<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_iks extends Model
{
    use HasFactory;
    protected $table='m_iks';
    protected $fillable=['kode', 'nama', 'penjamin_id', 'tipe_id', 'status_aktif', 'masa_berlaku_awal', 'masa_berlaku_akhir'];
    
    public function list_iks_tipe()
    {
        return $this->belongsTo(M_iks_tipe::class, 'tipe_id');
    }

    public function list_penjamin()
    {
        return $this->belongsTo(M_penjamin::class, 'penjamin_id');
    }
}
