<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SolicitudesTransportes;

class Lugares extends Model
{
    use HasFactory;

    public function Users(){
        return $this->hasMany(User::class);
    }

    public function SolicitudesTransportes(){
        return $this->hasMany(SolicitudesTransportes::class);
    }
}
