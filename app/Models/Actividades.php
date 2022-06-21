<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    use HasFactory;

    public function organizador()
    {
        return $this->belongsTo(Lugares::class, 'id_organizador');
    }

    public function coordinador()
    {
        return $this->belongsTo(User::class, 'id_coordinador');
    }

    public function lugar()
    {
        return $this->belongsTo(Lugares::class, 'id_lugar');
    }

    public function estado()
    {
        return $this->belongsTo(EstadosActividades::class, 'id_estado');
    }
}
