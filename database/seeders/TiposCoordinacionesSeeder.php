<?php

namespace Database\Seeders;

use App\Models\TiposCoordinaciones;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposCoordinacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos_coordinaciones=TiposCoordinaciones::create([
            'tipo_coordinacion' => 'Director de DISAM',
        ]);
        $tipo_coordinacion=TiposCoordinaciones::create([
            'tipo_coordinacion' => 'Coordinador de Alimentos y Bebidas',
        ]);
        $tipo_coordinacion=TiposCoordinaciones::create([
            'tipo_coordinacion' => 'Coordinadora de Zoonosis',
        ]);
        $tipo_coordinacion=TiposCoordinaciones::create([
            'tipo_coordinacion' => 'Administracion de DISAM',
        ]);
        $tipo_coordinacion=TiposCoordinaciones::create([
            'tipo_coordinacion' => 'Coordinador Saneamiento',
        ]);
        $tipo_coordinacion=TiposCoordinaciones::create([
            'tipo_coordinacion' => 'Coordinador de Unidad Ambiental',
        ]);
        $tipo_coordinacion=TiposCoordinaciones::create([
            'tipo_coordinacion' => 'Coordinacion Informatica',
        ]);
        $tipo_coordinacion=TiposCoordinaciones::create([
            'tipo_coordinacion' => 'Coordinacion de Alcohol y Tabaco',
        ]);
    }
}