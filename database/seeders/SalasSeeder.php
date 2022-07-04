<?php

namespace Database\Seeders;

use App\Models\Salas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sala=Salas::create([
            'sala' => 'Sala DISAM',
        ]);
    }
}
