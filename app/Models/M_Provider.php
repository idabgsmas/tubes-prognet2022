<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Provider extends Model
{
    use HasFactory;
    protected $table='m_provider';
    protected $fillable=['id','provider'];
}
