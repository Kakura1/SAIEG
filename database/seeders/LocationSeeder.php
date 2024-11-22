<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Estados
        $bajaCalifornia = DB::table('estados')->insertGetId([
            'nombre' => 'Baja California',
            'abreviatura' => 'BC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $bajaCaliforniaSur = DB::table('estados')->insertGetId([
            'nombre' => 'Baja California Sur',
            'abreviatura' => 'BCS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

        // Municipios de Baja California


        DB::table('municipios')->insert([
            ['nombre' => 'Tijuana', 'estado_id' => $bajaCalifornia, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Tecate', 'estado_id' => $bajaCalifornia, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Mexicali', 'estado_id' => $bajaCalifornia, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Quintin', 'estado_id' => $bajaCalifornia, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ensenada', 'estado_id' => $bajaCalifornia, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Rosarito', 'estado_id' => $bajaCalifornia, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Felipe', 'estado_id' => $bajaCalifornia, 'created_at' => now(), 'updated_at' => now()],
        ]);
        // Municipios de Baja California Sur

        DB::table('municipios')->insert([
            ['nombre' => 'La Paz', 'estado_id' => $bajaCaliforniaSur, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Los Cabos', 'estado_id' => $bajaCaliforniaSur, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Comondu', 'estado_id' => $bajaCaliforniaSur, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Loreto', 'estado_id' => $bajaCaliforniaSur, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Mulege', 'estado_id' => $bajaCaliforniaSur, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
