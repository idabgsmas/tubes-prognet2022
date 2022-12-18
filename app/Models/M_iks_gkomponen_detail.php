<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_iks_gkomponen_detail extends Model
{
    use HasFactory;
    protected $table='m_iks_gkomponen_detail';
    protected $fillable=['id','gkomponen_id','gkomponen_detail'];

    public function gkomponen()
    {
        return $this->belongsTo('App\Models\M_iks_gkomponen','gkomponen_id','id');
    }
}
