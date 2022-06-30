<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SolicitudesSalas;

class Salas extends Model
{
    use HasFactory;

    public function SolicitudesSalas()
    {
        return $this->hasMany(SolicitudesSalas::class);
    }
}
