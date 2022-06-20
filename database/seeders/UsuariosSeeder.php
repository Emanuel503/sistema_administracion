<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $useradmin=User::create([
            'id_rol' => 1,
            'id_dependencia' => 1,
            'id_estado' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'name' => 'admin',
            'cargo' => 'admin',
            'ubicacion' => 'DISAM',
            'telefono' => '2234-2345',
            'motorista' => 'no',
            ]);

        $user1=User::create([
            'id_rol' => 2,
            'id_dependencia' => 1,
            'id_estado' => 1,
            'email' => 'user@gmail.com',
            'password' => Hash::make('admin'),
            'name' => 'usuario',
            'cargo' => 'usuario',
            'ubicacion' => 'DISAM',
            'telefono' => '2234-2345',
            'motorista' => 'si',
            ]);
    }
}
