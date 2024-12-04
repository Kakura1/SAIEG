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
        $aguascalientes = DB::table('estados')->insertGetId([
            'nombre' => 'Aguascalientes',
            'abreviatura' => 'AGS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
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
        $campeche = DB::table('estados')->insertGetId([
            'nombre' => 'Campeche',
            'abreviatura' => 'CAMP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $chiapas = DB::table('estados')->insertGetId([
            'nombre' => 'Chiapas',
            'abreviatura' => 'CHIS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $chihuahua = DB::table('estados')->insertGetId([
            'nombre' => 'Chihuahua',
            'abreviatura' => 'CHIH',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $ciudadDeMexico = DB::table('estados')->insertGetId([
            'nombre' => 'Ciudad de México',
            'abreviatura' => 'CDMX',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $coahuila = DB::table('estados')->insertGetId([
            'nombre' => 'Coahuila',
            'abreviatura' => 'COAH',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $colima = DB::table('estados')->insertGetId([
            'nombre' => 'Colima',
            'abreviatura' => 'COL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $durango = DB::table('estados')->insertGetId([
            'nombre' => 'Durango',
            'abreviatura' => 'DGO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $guanajuato = DB::table('estados')->insertGetId([
            'nombre' => 'Guanajuato',
            'abreviatura' => 'GTO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $guerrero = DB::table('estados')->insertGetId([
            'nombre' => 'Guerrero',
            'abreviatura' => 'GRO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $hidalgo = DB::table('estados')->insertGetId([
            'nombre' => 'Hidalgo',
            'abreviatura' => 'HGO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $jalisco = DB::table('estados')->insertGetId([
            'nombre' => 'Jalisco',
            'abreviatura' => 'JAL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $mexico = DB::table('estados')->insertGetId([
            'nombre' => 'México',
            'abreviatura' => 'MEX',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $michoacan = DB::table('estados')->insertGetId([
            'nombre' => 'Michoacán',
            'abreviatura' => 'MICH',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $morelos = DB::table('estados')->insertGetId([
            'nombre' => 'Morelos',
            'abreviatura' => 'MOR',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $nayarit = DB::table('estados')->insertGetId([
            'nombre' => 'Nayarit',
            'abreviatura' => 'NAY',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $nuevoLeon = DB::table('estados')->insertGetId([
            'nombre' => 'Nuevo León',
            'abreviatura' => 'NL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $oaxaca = DB::table('estados')->insertGetId([
            'nombre' => 'Oaxaca',
            'abreviatura' => 'OAX',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $puebla = DB::table('estados')->insertGetId([
            'nombre' => 'Puebla',
            'abreviatura' => 'PUE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $queretaro = DB::table('estados')->insertGetId([
            'nombre' => 'Querétaro',
            'abreviatura' => 'QRO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $quintanaRoo = DB::table('estados')->insertGetId([
            'nombre' => 'Quintana Roo',
            'abreviatura' => 'QR',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $sanLuisPotosi = DB::table('estados')->insertGetId([
            'nombre' => 'San Luis Potosí',
            'abreviatura' => 'SLP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $sinaloa = DB::table('estados')->insertGetId([
            'nombre' => 'Sinaloa',
            'abreviatura' => 'SIN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $sonora = DB::table('estados')->insertGetId([
            'nombre' => 'Sonora',
            'abreviatura' => 'SON',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $tabasco = DB::table('estados')->insertGetId([
            'nombre' => 'Tabasco',
            'abreviatura' => 'TAB',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $tamaulipas = DB::table('estados')->insertGetId([
            'nombre' => 'Tamaulipas',
            'abreviatura' => 'TAMPS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $tlaxcala = DB::table('estados')->insertGetId([
            'nombre' => 'Tlaxcala',
            'abreviatura' => 'TLAX',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $veracruz = DB::table('estados')->insertGetId([
            'nombre' => 'Veracruz',
            'abreviatura' => 'VER',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $yucatan = DB::table('estados')->insertGetId([
            'nombre' => 'Yucatán',
            'abreviatura' => 'YUC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        $zacatecas = DB::table('estados')->insertGetId([
            'nombre' => 'Zacatecas',
            'abreviatura' => 'ZAC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
