<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IndustryPartner;
use App\Models\Project;
use App\Models\ProjectApplication;
use App\Models\Student;

class TeacherController extends Controller
{
    public function approve($id)
    {
        $industryPartner = IndustryPartner::find($id);
        $industryPartner->approved = true;
        $industryPartner->save();

        toast()
            ->success("{$industryPartner->user->name} has been approved")
            ->push();

        return redirect()->route('dashboard');
    }

    public function assign(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'trimester' => 'required|integer',
        ]);

        $year = $request->input('year');
        $trimester = $request->input('trimester');

        // Retrieve the list of projects for the selected offering (year and trimester)
        $projects = Project::where('year', $year)
            ->where('trimester', $trimester)
            ->get();

        foreach ($projects as $project) {
            $rolesToFill = ['software developer', 'project manager', 'business analyst', 'tester', 'client liaison'];
            $roleIds = [1, 2, 3, 4, 5];
            $potentialStudents = [];

            // add all students with an application for this project to the potential students array
            $potentialStudents = $project->applications->pluck('student')->sortByDesc('gpa');
            // pick ONE student for each role, remove other students from the potential students array

            // // push the students that have applied and have a needed role into the potential students array
            // foreach ($project->applications as $application) {
            //     $studentRoles = $application->student->roles;
            //     foreach ($studentRoles as $studentRole) {
            //         // Check if the student's role ID is in the list of required role IDs
            //         if (in_array($studentRole->id, $roleIds)) {
            //             // Add the student to the potential students array and break out of the loop
            //             $potentialStudents[] = $application->student;
            //             break;
            //         }
            //     }
            // }

            // assign the students to the project
            $project->potentialStudents = $potentialStudents->take($project->num_students_needed);

            // Update application status to accepted
            foreach ($project->potentialStudents as $student) {
                $application = ProjectApplication::where('student_id', $student->id)
                    ->where('project_id', $project->id)
                    ->first();
                $application->status = 'accepted';
                $application->save();
            }
        }

        // Redirect back with a success or error message
        toast()
            ->success('Students have been assigned successfully for the selected offering')
            ->push();

        return redirect()->route('projects.index');
    }
}
