<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Student;

class ProjectApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        // foreach ($students as $student) {
        //     DB::table('project_applications')->insert([
        //         'project_id' => Project::all()->random()->id,
        //         'student_id' => $student->id,
        //         'justification' => 'I am a highly motivated international student, trained in various programming languages.',
        //         'created_at' => now(),
        //     ]);
        // }
        // insert some project applications for trimester 1 2024
        $projects = Project::where('trimester', 1)
            ->where('year', 2024)
            ->get();
        $students = Student::all();

        foreach ($students as $student) {
            // Shuffle the projects collection and take 3 distinct random projects
            $selectedProjects = $projects
                ->shuffle()
                ->take(3)
                ->pluck('id')
                ->toArray();

            foreach ($selectedProjects as $projectId) {
                DB::table('project_applications')->insert([
                    'project_id' => $projectId,
                    'student_id' => $student->id,
                    'justification' => 'I am a highly motivated student, trained in various programming languages.',
                    'created_at' => now(),
                ]);
            }
        }

        // for each student create three applications randomly
        // foreach ($projects as $project) {
        //     DB::table('project_applications')->insert([
        //         'project_id' => $project->id,
        //         'student_id' => $students[0]->id,
        //         'justification' => 'I am a highly motivated international student, trained in various programming languages.',
        //         'created_at' => now(),
        //     ]);
        //     DB::table('project_applications')->insert([
        //         'project_id' => $project->id,
        //         'student_id' => $students[1]->id,
        //         'justification' => 'I am a highly motivated international student, trained in various programming languages.',
        //         'created_at' => now(),
        //     ]);
        //     DB::table('project_applications')->insert([
        //         'project_id' => $project->id,
        //         'student_id' => $students[4]->id,
        //         'justification' => 'I am a highly motivated international student, trained in various programming languages.',
        //         'created_at' => now(),
        //     ]);
        // }

        // DB::table('project_applications')->insert([
        //     'project_id' => $projects->last()->id,
        //     'student_id' => $students[2]->id,
        //     'justification' => 'I am a highly motivated international student, trained in various programming languages.',
        //     'created_at' => now(),
        // ]);
        // DB::table('project_applications')->insert([
        //     'project_id' => $projects->first()->id,
        //     'student_id' => $students[3]->id,
        //     'justification' => 'I am a highly motivated international student, trained in various programming languages.',
        //     'created_at' => now(),
        // ]);
    }
}
