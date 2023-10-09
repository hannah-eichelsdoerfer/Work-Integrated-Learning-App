<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProjectFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // pdfs
        DB::table('project_files')->insert([
            'project_id' => 1,
            'file_name' => 'Project 1 File 1',
            'file_type' => 'pdf',
            'file_path' => 'project-pdfs/dummy.pdf',
        ]);
        DB::table('project_files')->insert([
            'project_id' => 1,
            'file_name' => 'Project 1 File 2',
            'file_type' => 'pdf',
            'file_path' => 'project-pdfs/dummy.pdf',
        ]);
        DB::table('project_files')->insert([
            'project_id' => 2,
            'file_name' => 'Project 2 File 1',
            'file_type' => 'pdf',
            'file_path' => 'project_files/dummy.pdf',
        ]);
        // images
        $projects = DB::table('projects')->get();
        foreach ($projects as $project) {
            for ($i = 0; $i < 3; $i++) {
                DB::table('project_files')->insert([
                    'project_id' => $project->id,
                    'file_name' => $project->title . ' Image ' . $i,
                    'file_type' => 'image',
                    'file_path' => 'project-images/default.jpeg',
                ]);
            }
        }
    }
}
