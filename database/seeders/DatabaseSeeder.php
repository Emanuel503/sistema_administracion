<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RolesSeeder::class);
        $this->call(LugaresSeeder::class);
        $this->call(EstadosUsuariosSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(AutorizacionesSeeder::class);
        $this->call(SalasSeeder::class);
    }
}
