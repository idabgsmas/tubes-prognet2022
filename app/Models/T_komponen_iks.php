<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_komponen_iks extends Model
{
    use HasFactory;
    protected $table='t_komponen_ikss';
    protected $fillable=['id','iks_id', 'iks_gkomponen_id', 'provider_id' ,'group'];

        
    public function iks()
    {
        return $this->belongsTo('App\Models\M_iks','iks_id','id');
    }

    public function gkomponen()
    {
        return $this->belongsTo('App\Models\M_iks_gkomponen','gkomponen_id','id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\M_Provider','provider_id','id');
    }
}
