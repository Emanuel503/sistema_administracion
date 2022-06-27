<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudesTransportes extends Model
{
    use HasFactory;
    
    public function dependencias(){
        return $this->belongsTo(DependenciasTransporte::class, 'id_dependencia');
    }

    public function autorizacion(){
        return $this->belongsTo(Autorizaciones::class, 'id_autorizacion');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function lugar(){
        return $this->belongsTo(Lugares::class, 'id_lugar');
    }
}