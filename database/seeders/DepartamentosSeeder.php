<?php

namespace Database\Seeders;

use App\Models\Departamentos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ahuachapan=Departamentos::create([
            'departamento' => 'Ahuachapán',
        ]);

        $cabanas=Departamentos::create([
            'departamento' => 'Cabañas',
        ]);

        $chalatenango=Departamentos::create([
            'departamento' => 'Chalatenango',
        ]);

        $cuscatlan=Departamentos::create([
            'departamento' => 'Cuscatlán',
        ]);

        $la_libertad=Departamentos::create([
            'departamento' => 'La Libertad',
        ]);

        $la_paz=Departamentos::create([
            'departamento' => 'La Paz',
        ]);

        $la_union=Departamentos::create([
            'departamento' => 'La Unión',
        ]);

        $morazan=Departamentos::create([
            'departamento' => 'Morazán',
        ]);

        $san_miguel=Departamentos::create([
            'departamento' => 'San Miguel',
        ]);

        $san_alvador=Departamentos::create([
            'departamento' => 'San Salvador',
        ]);

        $san_vicente=Departamentos::create([
            'departamento' => 'San Vicente',
        ]);

        $santa_ana=Departamentos::create([
            'departamento' => 'Santa Ana',
        ]);

        $sonsonate=Departamentos::create([
            'departamento' => 'Sonsonate',
        ]);

        $usulutan=Departamentos::create([
            'departamento' => 'Usulután',
        ]);
    }
}