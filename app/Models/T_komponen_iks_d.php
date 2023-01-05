<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_komponen_iks_d extends Model
{
    use HasFactory;
    protected $table='t_komponen_ikss_d';
    protected $fillable=['id','komponen_ikss_id','komponen_iks_detail'];

    public function tkomponen()
    {
        return $this->belongsTo('App\Models\T_komponen_iks','komponen_ikss_id','id');
    }
}
