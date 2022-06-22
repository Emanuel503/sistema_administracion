<?php

namespace Database\Seeders;

use App\Models\EstadosActividades;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosActividadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado1=EstadosActividades::create([
            'tipo_estado' => 'Realizada',
        ]);

        $estado2=EstadosActividades::create([
            'tipo_estado' => 'Suspendida',
        ]);

        $estado3=EstadosActividades::create([
            'tipo_estado' => 'Pospuesta',
        ]);

        $estado4=EstadosActividades::create([
            'tipo_estado' => 'Inasistencia',
        ]);

        $estado5=EstadosActividades::create([
            'tipo_estado' => 'Pendiente',
        ]);
    }
}