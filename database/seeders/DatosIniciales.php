<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatosIniciales extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            'rol_id' => 2,
            'nombre' => 'Rudy Ajuchán',
            'correo' => 'rudy@skynet.com',
            'password' => Hash::make('rudy123'),
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
