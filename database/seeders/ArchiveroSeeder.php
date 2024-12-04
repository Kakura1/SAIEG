<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Archivist;

class ArchiveroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 5 carpetas
        $carpetas = Archivist::factory()
            ->count(5)
            ->create([
                'tipo' => 'carpeta', // Especifica que son carpetas
            ]);

        // Para cada carpeta, agregar 4 archivos
        foreach ($carpetas as $carpeta) {
            Archivist::factory()
                ->count(4)
                ->create([
                    'tipo' => 'archivo', // Especifica que son archivos
                    'parent_id' => $carpeta->id, // Relación con la carpeta padre
                ]);
        }
    }
}
