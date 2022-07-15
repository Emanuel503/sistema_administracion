<?php

namespace Database\Seeders;

use App\Models\TiposPermisos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_permiso=TiposPermisos::create([
            'tipo_permiso' => 'Con sueldo',
        ]);

        $tipo_permiso=TiposPermisos::create([
            'tipo_permiso' => 'Sin sueldo',
        ]);
    }
}