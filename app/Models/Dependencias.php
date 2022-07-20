<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SolicitudesTransportes;

class Dependencias extends Model
{
    use HasFactory;

    public function SolicitudesTransportes()
    {
        return $this->hasMany(SolicitudesTransportes::class);
    }
}
