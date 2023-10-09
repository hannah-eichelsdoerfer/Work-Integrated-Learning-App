<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\IndustryPartner;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Project::factory(10)->create();
        $industryPartners = IndustryPartner::all();
        foreach ($industryPartners as $industryPartner) {
            // check if industry partner is approved, then continute, else skip
            if ($industryPartner->approved === 1) {
                $numProjects = rand(4, 6);
                for ($i = 0; $i < $numProjects; $i++) {
                    DB::table('projects')->insert([
                        'title' => $industryPartner->user->name . ' Project ' . $i + 1,
                        'description' => 'This is the description for a ' . $industryPartner->user->name . ' Project.',
                        'contact_name' => $industryPartner->user->name,
                        'contact_email' => $industryPartner->user->email,
                        'num_students_needed' => rand(3, 6),
                        'trimester' => rand(1, 3),
                        'year' => rand(2020, 2024),
                        'created_at' => now(),
                        'industry_partner_id' => $industryPartner->id,
                    ]);
                }
            }
        }

        // Create 3 projects in trimester 1 2024
        DB::table('projects')->insert([
            'title' => 'Exciting Project 1',
            'description' => 'This is the description for a Trimester 1 2024 Project.',
            'contact_name' => 'John Doe',
            'contact_email' => 'hired@gmail.com',
            'num_students_needed' => rand(3, 6),
            'trimester' => 1,
            'year' => 2024,
            'created_at' => now(),
            'industry_partner_id' => User::where('name', 'Google')->get()->first()->industryPartner->id,
        ]);
        DB::table('projects')->insert([
            'title' => 'Exciting Project 2',
            'description' => 'This is the description for a Trimester 1 2024 Project.',
            'contact_name' => 'John Doe',
            'contact_email' => 'hired@meta.com',
            'num_students_needed' => rand(3, 6),
            'trimester' => 1,
            'year' => 2024,
            'created_at' => now(),
            'industry_partner_id' => User::where('name', 'Facebook')->get()->first()->industryPartner->id,
        ]);
        DB::table('projects')->insert([
            'title' => 'Exciting Project 3',
            'description' => 'This is the description for a Trimester 1 2024 Project.',
            'contact_name' => 'John Doe',
            'contact_email' => 'hired@microsoft.com',
            'num_students_needed' => rand(3, 6),
            'trimester' => 1,
            'year' => 2024,
            'created_at' => now(),
            'industry_partner_id' => User::where('name', 'Microsoft')->get()->first()->industryPartner->id,
        ]);
        DB::table('projects')->insert([
            'title' => 'Exciting Project 4',
            'description' => 'This is the description for a Trimester 1 2024 Project.',
            'contact_name' => 'John Doe',
            'contact_email' => 'hired@amazon.com.au',
            'num_students_needed' => rand(3, 6),
            'trimester' => 1,
            'year' => 2024,
            'created_at' => now(),
            'industry_partner_id' => User::where('name', 'Amazon')->get()->first()->industryPartner->id,
        ]);

    }
}
