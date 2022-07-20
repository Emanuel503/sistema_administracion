<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function usuarioAuto()
    {
        return $this->belongsTo(User::class, 'id_usuario_autoriza');
    }

    public function usuarioAdi()
    {
        return $this->belongsTo(User::class, 'id_usuario_adiciono');
    }

    public function depen()
    {
        return $this->belongsTo(Dependencias::class, 'id_dependencia');
    }

    public function licencia()
    {
        return $this->belongsTo(TiposPermisos::class, 'id_licencia');
    }

    public function motiv()
    {
        return $this->belongsTo(MotivosPermisos::class, 'id_motivo');
    }

    public function estado()
    {
        return $this->belongsTo(EstadosPermisos::class, 'id_estado');
    }
}
