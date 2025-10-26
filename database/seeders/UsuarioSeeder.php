<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            'rol_id' => 1,
            'nombre' => 'Administrador',
            'correo' => 'admin@skynet.com',
            'password' => Hash::make('admin123'),
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
