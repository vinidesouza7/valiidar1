<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupNames = [
            'Mecânica',
            'Revenda',
            'Cliente Final',
            'Seguradora',
            'Público',
            'Taxi',
            'Locadora',
            'Autoescola',
            'Colecionador'
        ];

        foreach ($groupNames as $name) {
            Group::create(['name' => $name]);
        }
    }
}
