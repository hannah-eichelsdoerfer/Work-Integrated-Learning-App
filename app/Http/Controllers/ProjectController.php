<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // only allow access to create if user is type industry partner
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:industry-partner');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // There is a projects-list page that displays all projects (names) group by the year and trimester of offering.
        // For each group of projects, the grouping should be obvious and the year and trimester for that group should be clearly displayed.
        // The groups are displayed in reverse chronological order, i.e. the latest year/trimester should be displayed at the top, follow by the 2nd latest group.
        // Clicking on a project will bring up the details page for that project.
        $projects = Project::orderBy('year', 'desc')
            ->orderBy('trimester', 'desc')
            ->get()
            ->groupBy(['year', 'trimester']);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $user = Auth::user(); // Get the currently authenticated user
        $industryPartner = $user->industryPartner; // Get the industry partner associated with the user
        $project = Project::create($request->validated() + ['industry_partner_id' => $industryPartner->id]);

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // display Project info
        $project = Project::find($project->id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // validate and update Project info
        $project->update($request->validated());

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->applications->count() > 0) {
            toast()
                ->danger('Project has applications and cannot be deleted.')
                ->push();
            return redirect()
                ->route('projects.show', $project->id);
        }

        $project->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Project deleted successfully.');
    }
}
