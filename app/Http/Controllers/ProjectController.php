<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    // only allow access to create if user is type industry partner
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkUserType:Industry Partner')->only(['create', 'store', 'edit', 'update', 'destroy']);
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
    public function create()
    {
        return "create project form";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $user = Auth::user(); // Get the currently authenticated user
        $industryPartner = $user->industryPartner; // Get the industry partner associated with the user

        // Check if the user is an approved industry partner
        if (!$industryPartner->approved) {
            toast()
                ->danger('You are not yet an approved industry partner.')
                ->push();
            return redirect()->route('dashboard');
        }

        // Create the project
        $project = Project::create($request->validated() + ['industry_partner_id' => $industryPartner->id]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('project-images', 'public');
                $project->projectFiles()->create([
                    'file_path' => $imagePath,
                    'file_type' => 'image',
                    'file_name' => $image->getClientOriginalName(),
                ]);
            }
        } else {
            $project->projectFiles()->create([
                'file_path' => 'project-images/default.jpeg',
                'file_type' => 'image',
                'file_name' => 'Placeholder Image',
            ]);
        }

        // Handle PDF uploads
        if ($request->hasFile('pdfs')) {
            foreach ($request->file('pdfs') as $pdf) {
                $pdfPath = $pdf->store('project-pdfs', 'public');
                $project->projectFiles()->create([
                    'file_path' => $pdfPath,
                    'file_type' => 'pdf',
                    'file_name' => $pdf->getClientOriginalName(),
                ]);
            }
        }

        $project->save();

        toast()
            ->success('Project created successfully.')
            ->push();

        return redirect()->route('projects.show', $project);
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
        $project->update($request->validated());

        toast()
            ->success('Project updated successfully.')
            ->push();

        return redirect()->route('projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // thorw error if user is not the owner of the project
        if ($project->industry_partner_id !== Auth::user()->industryPartner->id) {
            toast()
                ->danger('You are not the owner of this project.')
                ->push();
            return redirect()->route('projects.show', $project->id);
        }


        if ($project->applications->count() > 0) {
            toast()
                ->danger('Project has applications and cannot be deleted.')
                ->push();
            return redirect()->route('projects.show', $project->id);
        }

        $project->delete();

        toast()
            ->success('Project deleted successfully.')
            ->push();

        return redirect()->route('dashboard');
    }
}
