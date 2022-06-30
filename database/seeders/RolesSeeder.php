<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Roles::create([
            'rol' => 'Administrador',
        ]);
        $user = Roles::create([
            'rol' => 'Analista',
        ]);
        $user = Roles::create([
            'rol' => 'Digitador',
        ]);
        $user = Roles::create([
            'rol' => 'Participante',
        ]);
        $user = Roles::create([
            'rol' => 'Motorista',
        ]);
        $user = Roles::create([
            'rol' => 'Jefe de conservación',
        ]);
    }
}
