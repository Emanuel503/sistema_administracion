<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosPermisos extends Model
{
    use HasFactory;

    public function coordinador()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
