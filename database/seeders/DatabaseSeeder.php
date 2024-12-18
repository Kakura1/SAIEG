<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            LocationSeeder::class,
            ArchiveroSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);
        
        $user = User::create([
            'name' => 'Usuario Administrador',
            'email' => 'useradmin@example.com',
            'password' => Hash::make('12345678'),
        ]);        
        $user->assignRole('administrador');

        $user2 = User::create([
            'name' => 'Usuario Administrador',
            'email' => 'useradmin2@example.com',
            'password' => Hash::make('12345678'),
        ]);        
        $user2->assignRole('consultor');

        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
