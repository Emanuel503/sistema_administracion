<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCombustible extends Model
{
    use HasFactory;

    public function destinatario()
    {
        return $this->belongsTo(User::class, 'id_destinatario');
    }

    public function origen()
    {
        return $this->belongsTo(User::class, 'id_origen');
    }

    public function conductor()
    {
        return $this->belongsTo(User::class, 'id_conductor');
    }

    public function lugar_d()
    {
        return $this->belongsTo(Lugares::class, 'lugar_destino');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculos::class, 'id_vehiculo');
    }
}
