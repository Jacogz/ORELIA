<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        \App\Models\User::create([
            'name'      => 'Admin',
            'last_name' => 'Orelia',
            'email'     => 'admin@orelia.com',
            'password'  => bcrypt('password123'),
            'role'      => 'admin',
            'address'   => 'Medellín, Colombia',
        ]);

        \App\Models\User::create([
            'name'      => 'Cliente',
            'last_name' => 'Prueba',
            'email'     => 'cliente@orelia.com',
            'password'  => bcrypt('password123'),
            'role'      => 'client',
            'address'   => 'Bello, Antioquia',
        ]);
    }
}