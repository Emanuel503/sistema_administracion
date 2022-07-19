<?php

namespace Database\Seeders;

use App\Models\EstadosPermisos;
use App\Models\Permisos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permiso1 = EstadosPermisos::create([
            'estado' => 'Aprobada',
        ]);

        $permiso1 = EstadosPermisos::create([
            'estado' => 'Rechazada',
        ]);

        $permiso1 = EstadosPermisos::create([
            'estado' => 'Pendiente',
        ]);
    }
}
