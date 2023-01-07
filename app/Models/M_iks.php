<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class M_iks extends Model
{
    use HasFactory;
    protected $table='m_ikss';
    protected $fillable=['id','kode','nama','penjamin_id','tipe_id','provider_id','status_aktif','masa_berlaku_awal','masa_berlaku_akhir'];
    
    public function list_iks_tipe()
    {
        return $this->belongsTo('App\Models\M_iks_tipe','tipe_id','id');
    }

    public function list_penjamin()
    {
        return $this->belongsTo('App\Models\M_penjamin','penjamin_id','id');
    }

    public function list_provider()
    {
        return $this->belongsTo('App\Models\M_Provider','provider_id','id');
    }
}
