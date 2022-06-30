<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actividades;

class EstadosActividades extends Model
{
    use HasFactory;

    public function Actividades()
    {
        return $this->hasMany(Actividades::class);
    }
}
