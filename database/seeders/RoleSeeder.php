<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'Software Developer'
        ]);
        DB::table('roles')->insert([
            'name' => 'Project Manager',
        ]);
        DB::table('roles')->insert([
            'name' => 'Business Analyst'
        ]);
        DB::table('roles')->insert([
            'name' => 'Tester'
        ]);
        DB::table('roles')->insert([
            'name' => 'Client Liaison'
        ]);
    }
}
