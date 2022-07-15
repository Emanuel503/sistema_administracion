<?php

namespace Database\Seeders;

use App\Models\MotivosPermisos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotivosPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motivo=MotivosPermisos::create([
            'motivo' => 'Personal',
        ]);
        $motivo=MotivosPermisos::create([
            'motivo' => 'Enfermedad',
        ]);
        $motivo=MotivosPermisos::create([
            'motivo' => 'Enfermedad gravísima de pariente',
        ]);
        $motivo=MotivosPermisos::create([
            'motivo' => 'Duelo',
        ]);
        $motivo=MotivosPermisos::create([
            'motivo' => 'Compensatorio',
        ]);
        $motivo=MotivosPermisos::create([
            'motivo' => 'Oficial',
        ]);
    }
}