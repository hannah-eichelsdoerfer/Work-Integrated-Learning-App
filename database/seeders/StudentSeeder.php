<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            'user_id' => 9,
            'gpa' => '5.5',
        ]);
        DB::table('students')->insert([
            'user_id' => 10,
            'gpa' => '6.5',
        ]);
    }
}
