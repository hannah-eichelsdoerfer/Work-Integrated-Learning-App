<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\ProjectApplication;

class ProjectApplicationController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * TODO: Add authorization checks to ensure that only students can apply to projects.
     */

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the current user's student
        $student = auth()->user()->student;
        // Get the student's applications
        $applications = $student->applications;
        // Return the view
        return view('applications.index', compact('applications'));
    }

    /**
     * Display the form for applying to a project.
     */
    public function create(Project $project)
    {
        return view('project-applications.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Project $project, Request $request)
    {
        // thorw error if user is not a student or user has not completed profile
        if (
            auth()->user()->type !== 'Student' ||
            !auth()
                ->user()
                ->student->hasCompletedProfile()
        ) {
            abort(403);
        }

        // Validate the incoming data (e.g., justification, etc.)
        $request->validate([
            'justification' => 'required|string|min_words:10',
        ]);

        // Count the user's previous applications within the trimester and year
        $applicationsCount = ProjectApplication::where('student_id', auth()->user()->student->id)
            ->whereHas('project', function ($query) use ($project) {
                $query->where('trimester', $project->trimester)->where('year', $project->year);
            })
            ->count();

        // Check if the count exceeds the limit (3 in this case)
        if ($applicationsCount >= 3) {
            toast()
                ->danger('You have already applied to three projects this trimester. You cannot apply to more.')
                ->push();
                
            return redirect()
                ->back()
                ->with('error', 'You have already applied to three projects this trimester. You cannot apply to more.');
        }

        // Create a new ProjectApplication and associate it with the project and student
        $application = ProjectApplication::create([
            'project_id' => $project->id,
            'student_id' => auth()->user()->student->id,
            'justification' => $request->justification,
        ]);

        // Redirect back to the project details page or show a success message
        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Project application submitted successfully.');
    }

    // project id
    public function apply(Project $project)
    {
        // $user = auth()->user();

        // // Check if the user is a student and has filled out GPA and roles
        // if ($user->type === 'Student' && $user->student && $user->student->hasCompletedProfile()) {
        //     // User has completed profile, display application form
        //     return view('projects.application', compact('project'));
        // }

        // // User has not completed profile, display profile completion form
        // return view('projects.profile_completion');
    }
}
