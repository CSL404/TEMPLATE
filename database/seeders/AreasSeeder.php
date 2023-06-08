<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Area::create([
            'description'  => 'Administrador',
            'active'       => 1
        ]);

        Area::create([
            'description'  => 'Usuario',
            'active'       => 1
        ]);
    }
}
