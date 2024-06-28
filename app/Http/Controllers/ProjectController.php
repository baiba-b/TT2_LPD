<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectRole;
use App\Models\User;
use App\Models\Connection;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;


use Carbon\Carbon;

class ProjectController extends Controller
{
    use AuthorizesRequests;
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

        $project->users()->attach(auth()->id(), ['role_id' => 1]);
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
  public function show($id)
{
     $project = Project::with('creator')->findOrFail($id);
     if (Gate::denies('view-project', $project)) {
        abort(403, 'Unauthorized action.');
    }

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
        $this->authorize('update-project', $project);
        if (!$project) {
            return redirect()->route('projects.index')->with('error', 'Project not found.');
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
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
        $project = Project::find($id);
        $this->authorize('update-project', $project);
        Project::destroy($id);
        return redirect()->route('projects.index');
    }

    public function showParticipants(string $id)
    {
        $project = Project::find($id);
        $users = $project->users;
        if (Gate::denies('view-project', $project)) {
            abort(403, 'Unauthorized action.');
        }
        return view('projectsParticipants', compact('project', 'users'));
    }

    public function addMember($id)
    {
        $project = Project::findOrFail($id);

        // Get IDs of users connected to the authenticated user
        $project = Project::findOrFail($id);
        $users = User::all(); // Get all users or filter as necessary
        $roles = ProjectRole::where('id', '!=', 1)->get();
        return view('projectsAddMember', compact('project', 'users', 'roles'));
    }

    public function storeMember(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $user = User::findOrFail($request->user_id); // Find the user by the provided user ID

        // Attach the user to the project with the selected role
        $project->users()->attach($user->id, ['role_id' => $request->role_id]);

        return redirect()->route('projects.show', $project)->with('success', 'Member added successfully.');
    }

    public function addInvestedTime(Request $request, $id)
    {
        $request->validate([
            'invested_time' => 'required|integer|min:0',
        ]);
    
        $project = Project::findOrFail($id);
        $project->invested_time += $request->input('invested_time');
        $project->save();
    
        return redirect()->route('projects.index')->with('success', 'Invested time added successfully.');
    }
}
