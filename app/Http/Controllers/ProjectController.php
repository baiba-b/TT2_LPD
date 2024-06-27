<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByRaw('due_date IS NULL, due_date ASC')->get();
        $projectsCount =  $projects->count();
        $now = Carbon::now();
        $missedDeadlinesCount = $projects->where('due_date', '<', $now)->count();

        return view('projects', [
            'projects' => $projects,
            'projectsCount' => $projectsCount,
            'missedDeadlinesCount' => $missedDeadlinesCount,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projectCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'estimated_workload' => 'required|integer|min:0',
        ]);


        $project = new Project();
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->due_date = $request->input('due_date');
        $project->estimated_workload = $request->input('estimated_workload');
        $project->creator_id = auth()->id();
        $project->save();
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
  public function show($id)
{
     $project = Project::with('creator')->findOrFail($id);

        return view('projectShow', compact('project'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        return view('projectEdit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::find($id);
    
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found.');
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'estimated_workload' => 'required|integer|min:0',
        ]);
    
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->due_date = $request->input('due_date');
        $project->estimated_workload = $request->input('estimated_workload');
        $project->save();
    
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::destroy($id);
        return redirect()->route('projects.index');
    }

    public function showParticipants(string $id)
    {
        $project = Project::find($id);
        $participants = $project->participants;

        return view('projectsParticipants', compact('project', 'participants'));
    }

    public function addMember($id)
    {
        $project = Project::findOrFail($id);
        $users = User::all(); // Get all users or filter as necessary

        return view('projects.addMember', compact('project', 'users'));
    }

    public function storeMember(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $user = User::findOrFail($request->user_id);
        $project->users()->attach($user, ['role_id' => $request->role_id]);

        return redirect()->route('projects.show', $project)->with('success', 'Member added successfully.');
    }

}
