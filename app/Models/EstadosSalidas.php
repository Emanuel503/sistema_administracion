<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosSalidas extends Model
{
    use HasFactory;

    public function RegistrosSalidas()
    {
        return $this->hasMany(RegistrosSalidas::class);
    }
}
