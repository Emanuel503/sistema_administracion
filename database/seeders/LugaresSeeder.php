<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lugares;

class LugaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $useradmin=Lugares::create([
            'codigo' => '30',
            'nombre' => 'HOSPITAL SAN JUAN DE DIOS, SANTA ANA',
            ]);
    }
}
