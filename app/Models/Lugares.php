<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SolicitudesTransportes;
use App\Models\RegistrosSalidas;

class Lugares extends Model
{
    use HasFactory;

    public function Departamentos()
    {
        return $this->belongsTo(Departamentos::class, 'id_departamento');
    }

    public function Municipios()
    {
        return $this->belongsTo(Municipios::class, 'id_municipio');
    }

    public function Users()
    {
        return $this->hasMany(User::class);
    }

    public function SolicitudesTransportes()
    {
        return $this->hasMany(SolicitudesTransportes::class);
    }

    public function RegistrosSalidas()
    {
        return $this->hasMany(RegistrosSalidas::class);
    }

    public function Transporte()
    {
        return $this->hasMany(Transporte::class);
    }
}