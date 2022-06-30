<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudesSalas extends Model
{
    use HasFactory;

    public function sala()
    {
        return $this->belongsTo(Salas::class, 'id_sala');
    }

    public function autorizacion()
    {
        return $this->belongsTo(Autorizaciones::class, 'id_autorizacion');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
