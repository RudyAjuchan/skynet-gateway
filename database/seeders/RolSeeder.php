<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rols')->insert([
            ['nombre' => 'Supervisor', 'estado' => 1],
            ['nombre' => 'Tecnico', 'estado' => 1]
        ]);
    }
}
