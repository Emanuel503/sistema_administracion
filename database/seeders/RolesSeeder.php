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
        $admin=Roles::create([
            'rol' => 'Administrador',
            ]);

        $user=Roles::create([
            'rol' => 'Usuario',
            ]);
    }
}
