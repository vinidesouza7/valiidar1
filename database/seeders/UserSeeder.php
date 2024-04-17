<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Gerente1',
            'email' => 'gerente1@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('drugovich123@'),
            'level' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Gerente2',
            'email' => 'gerente2@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('drugovich123@'),
            'level' => 2,
            'remember_token' => Str::random(10),
        ]);
    }
}
