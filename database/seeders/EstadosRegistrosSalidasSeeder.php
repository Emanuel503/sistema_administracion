<?php

namespace Database\Seeders;

use App\Models\EstadosSalidas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosRegistrosSalidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado=EstadosSalidas::create([
            'estado' => 'Pendiente',
        ]);

        $estado=EstadosSalidas::create([
            'estado' => 'Realizada',
        ]);

        $estado=EstadosSalidas::create([
            'estado' => 'Cancelada',
        ]);

        $estado=EstadosSalidas::create([
            'estado' => 'Pospuesta',
        ]);
    }
}
