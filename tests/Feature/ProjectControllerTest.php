<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectApplication;
use App\Models\IndustryPartner;
use App\Models\Student;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_project_index_can_be_rendered(): void
    {
        $user = User::factory()->create(['type' => 'Industry Partner']);

        $response = $this->actingAs($user)->get('/projects');

        $response->assertStatus(200);
    }

    public function test_project_creation_with_valid_data()
    {
        // Create an authenticated user (e.g., an industry partner)
        $user = User::factory()->create(['type' => 'Industry Partner']);
        $industryPartner = IndustryPartner::create(['user_id' => $user->id, 'approved' => true]);

        // check that the user is an approved industry partner
        $this->assertTrue($industryPartner->approved);

        $projectData = [
            'title' => 'New Project',
            'description' => 'This is a new project.',
            'contact_name' => 'John Doe',
            'contact_email' => 'john@gmail.com',
            'num_students_needed' => 5,
            'trimester' => 3,
            'year' => 2021,
            'industry_partner_id' => $user->id,
        ];

        $response = $this->actingAs($user)->post('/projects', $projectData);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/projects/1')
            ->assertStatus(302);

        $this->assertDatabaseCount('projects', 1);
        $this->assertDatabaseHas('projects', [
            'title' => $projectData['title'],
            'description' => $projectData['description'],
            'contact_name' => $projectData['contact_name'],
            'contact_email' => $projectData['contact_email'],
            'num_students_needed' => $projectData['num_students_needed'],
            'trimester' => $projectData['trimester'],
            'year' => $projectData['year'],
            'industry_partner_id' => $projectData['industry_partner_id'],
        ]);
    }

    public function test_project_creation_with_invalid_data()
    {
        // Create an authenticated user (e.g., an industry partner)
        $user = User::factory()->create(['type' => 'Industry Partner']);
        $industryPartner = IndustryPartner::create(['user_id' => $user->id, 'approved' => true]);

        // check that the user is an approved industry partner
        $this->assertTrue($industryPartner->approved);

        // Create invalid project data (e.g., missing required fields)
        $projectData = [
            'title' => '', // Missing title
            'description' => 'This is a new project.',
            'contact_name' => 'John Doe',
            'contact_email' => 'john@gmail.com',
            'num_students_needed' => 5,
            'trimester' => 3,
            'year' => 2021,
            'industry_partner_id' => $user->id,
        ];

        // Make a POST request to store the project with invalid data
        $response = $this->actingAs($user)->post('/projects', $projectData);
        // Assert that the project creation failed due to validation errors for 'title'
        $response->assertSessionHasErrors(['title']);
    }

    public function test_project_creation_with_duplicate_name()
    {
        // Create an authenticated user (e.g., an industry partner)
        $user = User::factory()->create(['type' => 'Industry Partner']);
        $industryPartner = IndustryPartner::create(['user_id' => $user->id, 'approved' => true]);

        $projectData = [
            'title' => 'Existing Project', // Same title as the existing project
            'description' => 'This is a new project.',
            'contact_name' => 'John Doe',
            'contact_email' => 'john@gmail.com',
            'num_students_needed' => 5,
            'trimester' => 3,
            'year' => 2021,
            'industry_partner_id' => $user->id,
        ];
        // Create a project with a unique name (to simulate existing project)
        $existingProject = Project::create($projectData);
        // Make a POST request to store the project with a duplicate name
        $response = $this->actingAs($user)->post('/projects', $projectData);

        // Assert that the project creation failed due to a duplicate name
        $response->assertSessionHasErrors(['title']);
    }

    public function test_successful_project_deletion()
    {
        // Create an authenticated user (e.g., an industry partner)
        $user = User::factory()->create(['type' => 'Industry Partner']);
        $industryPartner = IndustryPartner::create(['user_id' => $user->id, 'approved' => true]);
        $this->actingAs($user);

        // check that the user is an approved industry partner
        $this->assertTrue($industryPartner->approved);

        // Create a project to be deleted
        $project = Project::factory()->create(['industry_partner_id' => $user->id]);

        // Make a DELETE request to delete the project
        $response = $this->delete("/projects/{$project->id}");

        // Assert that the project was deleted successfully
        $response->assertStatus(302)->assertRedirect('/dashboard');

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
        $this->assertDatabaseCount('projects', 0);
    }

    public function test_unsuccessfull_project_deletion()
    {
        // Create an authenticated user (e.g., an industry partner)
        $user = User::factory()->create(['type' => 'Industry Partner']);
        $industryPartner = IndustryPartner::create(['user_id' => $user->id, 'approved' => true]);
        $this->actingAs($user);

        // Create a project with applications (to simulate an unsuccessful deletion)
        $project = Project::factory()->create(['industry_partner_id' => $user->id]);
        $user = User::factory()->create(['type' => 'Student']);
        $student = Student::create(['user_id' => $user->id]);
        ProjectApplication::create(['project_id' => $project->id, 'student_id' => $student->id]);

        // Attempt to delete the project with applications
        $response = $this->delete("/projects/{$project->id}");


        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
        ]);
        $this->assertDatabaseCount('projects', 1);

    }
}
