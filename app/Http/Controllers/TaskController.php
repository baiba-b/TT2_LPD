<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskRole;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderByRaw('due_date IS NULL, due_date ASC')->get();
        return view('tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasksCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'estimated_workload' => 'nullable|integer|min:0',
        ]);

        // Create the task
        $task = Task::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
            'estimated_workload' => $request->input('estimated_workload'),
            'creator_id' => auth()->id(),
        ]);
     
        $task->users()->attach($task->creator_id, ['role_id' => 1]);
            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with('creator')->findOrFail($id);

        return view('taskShow', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);
        return view('taskEdit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
    
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'Task not found.');
        }
    
        $request->validate([
            'name' => 'required|string|max:255', // Keep required if name is still mandatory
            'description' => 'nullable|string', 
            'due_date' => 'nullable|date',       
            'estimated_workload' => 'nullable|integer|min:0', 
        ]);
        
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->estimated_workload = $request->input('estimated_workload');
        $task->save();
    
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::destroy($id);
        return redirect()->route('tasks.index');
    
    }
    public function showParticipants(string $id)
    {
        $task = Task::find($id);
        $users = $task->users;
        return view('tasksParticipants', compact('task', 'users'));
    }
    public function addMember($id)
    {
        $task = task::findOrFail($id);

        // Get IDs of users connected to the authenticated user
        $task = task::findOrFail($id);
        $users = User::all(); // Get all users or filter as necessary
        $roles = taskRole::where('id', '!=', 1)->get();
        return view('tasksAddMember', compact('task', 'users', 'roles'));
    }

    public function storeMember(Request $request, $id)
    {
        $task = task::findOrFail($id);
        $user = User::findOrFail($request->user_id); // Find the user by the provided user ID
        // Attach the user to the task with the selected role
        $task->users()->attach($user->id, ['role_id' => $request->role_id]);

        return redirect()->route('tasks.show', $task)->with('success', 'Member added successfully.');
    }
    public function addInvestedTime(Request $request, $id)
    {
        $request->validate([
            'invested_time' => 'required|integer|min:0',
        ]);

        $task = Task::findOrFail($id);
        $task->invested_time += $request->input('invested_time');
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Invested time added successfully.');
    }

}
