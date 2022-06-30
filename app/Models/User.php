<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function rol()
    {
        return $this->belongsTo(Roles::class, 'id_rol');
    }

    public function dependencia()
    {
        return $this->belongsTo(Lugares::class, 'id_dependencia');
    }

    public function estadoUsuario()
    {
        return $this->belongsTo(EstadosUsuarios::class, 'id_estado');
    }

    public function SolicitudesSalas()
    {
        return $this->hasMany(SolicitudesSalas::class);
    }

    public function SolicitudesTransporte()
    {
        return $this->hasMany(SolicitudesTransportes::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_rol',
        'id_dependencia',
        'id_estado',
        'email',
        'usuario',
        'password',
        'nombres',
        'apellidos',
        'cargo',
        'ubicacion',
        'telefono',
        'motorista',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
