<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students_roles')->insert([
            'student_id' => 1,
            'role_id' => 1,
        ]);
        DB::table('students_roles')->insert([
            'student_id' => 1,
            'role_id' => 2,
        ]);
        DB::table('students_roles')->insert([
            'student_id' => 2,
            'role_id' => 1,
        ]);
        DB::table('students_roles')->insert([
            'student_id' => 2,
            'role_id' => 3,
        ]);
        DB::table('students_roles')->insert([
            'student_id' => 2,
            'role_id' => 5,
        ]);
    }
}
