<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SolicitudesTransportes;

class Vehiculos extends Model
{
    use HasFactory;

    public function SolicitudesTransporte()
    {
        return $this->hasMany(SolicitudesTransportes::class);
    }
}
