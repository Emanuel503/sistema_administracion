<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrosSalidas extends Model
{
    use HasFactory;

    public function estado()
    {
        return $this->belongsTo(EstadosSalidas::class, 'id_estado');
    }

    public function lugar()
    {
        return $this->belongsTo(Lugares::class, 'id_lugar');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}