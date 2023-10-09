<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Role;

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
            'role_id' => 5,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 5,
            'role_id' => 4,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 6,
            'role_id' => 1,
        ]);
        DB::table('student_roles')->insert([
            'student_id' => 6,
            'role_id' => 4,
        ]);

        $allStudents = Student::all();
        $students = $allStudents->slice(6); // Exclude the first 6 entries
        $roles = Role::all()->shuffle();

        foreach ($students as $student) {
            $selectedRoles = $roles->random(rand(1, 5)); // Randomly select 1 or up to 5 roles
            $roleIds = $selectedRoles->pluck('id')->toArray();

            foreach ($roleIds as $roleId) {
                DB::table('student_roles')->insert([
                    'student_id' => $student->id,
                    'role_id' => $roleId,
                ]);
            }
        }
    }
}
