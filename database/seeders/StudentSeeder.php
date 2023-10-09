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
        // find all users of type student and create a student for each
        $students = DB::table('users')->where('type', 'Student')->get();
        foreach ($students as $student) {
            DB::table('students')->insert([
                'user_id' => $student->id,
                'gpa' => rand(300, 700) / 100,
                'created_at' => now(),
            ]);
        }
    }
}
