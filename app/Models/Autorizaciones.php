<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SolicitudesSalas;
use App\Models\SolicitudesTransportes;

class Autorizaciones extends Model
{
    use HasFactory;

    public function SolicitudesSalas(){
        return $this->hasMany(SolicitudesSalas::class);
    }

    public function SolicitudesTranporte(){
        return $this->hasMany(SolicitudesTransportes::class);
    }
}
