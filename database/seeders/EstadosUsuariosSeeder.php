<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EstadosUsuarios;

class EstadosUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado1=EstadosUsuarios::create([
            'estado' => 'Activo',
            ]);

        $estado2=EstadosUsuarios::create([
            'estado' => 'Incativo',
            ]);
    }
}
