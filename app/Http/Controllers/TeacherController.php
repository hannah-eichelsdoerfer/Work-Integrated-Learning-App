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
            'project_id' => 'required|exists:projects,id',
            'student_id' => 'required|exists:students,id',
        ]);

        // $student = Student::find($request->student_id);
        // $student->project_id = $request->project_id;
        // $student->save();

        // Retrieve the selected offering (year and trimester)
        $year = $request->input('year');
        $trimester = $request->input('trimester');

        // Retrieve the list of projects for the selected offering
        $projects = Project::where('year', $year)
            ->where('trimester', $trimester)
            ->get();

        // for each project, retrieve the list of students who have applied for it
        foreach ($projects as $project) {
            $project->applications = ProjectApplication::where('project_id', $project->id)->get();
        }

        // dd($projects);

        // // Retrieve the list of students who have applied for projects in the same offering
        // $students = Student::whereHas('applications', function ($query) use ($year, $trimester) {
        //     $query->where('year', $year)->where('trimester', $trimester);
        // })->get();

        // dd($students);

        // Implement your assignment logic here based on the specified conditions
        // You can start with the conditions described in your requirements and add more as needed.

        // Update the database records to reflect project-student assignments
        // Handle cases where some projects cannot be assigned any students

        // Redirect back with a success or error message
        toast()
            ->success('Students been assigned successfully for the selected offering')
            ->push();

        return redirect()->route('dashboard');
    }
}
