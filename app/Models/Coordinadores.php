<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinadores extends Model
{
    use HasFactory;

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_tecnico');
    }

    public function coordinacion()
    {
        return $this->belongsTo(TiposCoordinaciones::class, 'id_coordinacion');
    }
}
