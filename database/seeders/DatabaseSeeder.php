<?php

namespace Database\Seeders;

use App\Models\EstadosActividades;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(LugaresSeeder::class);
        $this->call(EstadosUsuariosSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(AutorizacionesSeeder::class);
        $this->call(SalasSeeder::class);
        $this->call(EstadosActividadesSeeder::class);
    }
}