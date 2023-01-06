<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_iks_gkomponen extends Model
{
    use HasFactory;
    protected $table='m_iks_gkomponen';
    protected $fillable=['id','group'];

    public function gkomponen_d()
    {
        return $this->hasOne(M_iks_gkomponen_detail::class, 'gkomponen_id');
    }
}
