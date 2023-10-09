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
        DB::table('student_roles')->insert([
            'student_id' => 1,
            'role_id' => 1,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 1,
            'role_id' => 2,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 2,
            'role_id' => 1,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 2,
            'role_id' => 3,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 2,
            'role_id' => 5,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 3,
            'role_id' => 1,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 3,
            'role_id' => 2,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 3,
            'role_id' => 3,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 3,
            'role_id' => 4,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 4,
            'role_id' => 1,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 4,
            'role_id' => 7,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 5,
            'role_id' => 6,
        ]);
    }
}
