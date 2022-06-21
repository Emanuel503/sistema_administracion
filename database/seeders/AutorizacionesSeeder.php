<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Autorizaciones;

class AutorizacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $autorizacion1=Autorizaciones::create([
            'autorizacion' => 'Autorizado',
        ]);

        $autorizacion2=Autorizaciones::create([
            'autorizacion' => 'No Autorizado',
        ]);

        $autorizacion3=Autorizaciones::create([
            'autorizacion' => 'Pendiente',
        ]);
    }
}
