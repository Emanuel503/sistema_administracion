<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    use HasFactory;

    public function conductor()
    {
        return $this->belongsTo(User::class, 'id_conductor');
    }

    public function pasajeros()
    {
        return $this->belongsTo(User::class, 'pasajero');
    }

    public function lugar_s()
    {
        return $this->belongsTo(Lugares::class, 'lugar_salida');
    }

    public function lugar_d()
    {
        return $this->belongsTo(Lugares::class, 'lugar_destino');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculos::class, 'id_placa');
    }
    public function dependencias()
    {
        return $this->belongsTo(DependenciasTransporte::class, 'id_dependencia');
    }
}
