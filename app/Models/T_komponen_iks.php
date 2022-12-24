<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_komponen_iks extends Model
{
    use HasFactory;
    protected $table='t_komponen_iks';
    protected $fillable=['id','iks_provider_id', 'iks_gkomponen_id', 'group'];

        
    public function iks()
    {
        return $this->belongsTo('App\Models\M_iks','iks_id','id');
    }

    public function gkomponen()
    {
        return $this->belongsTo('App\Models\M_iks_gkomponen','gkomponen_id','id');
    }
}
