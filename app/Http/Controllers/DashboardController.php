<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $authUser = auth()->user();
      
        // Calculate remaining time and workload ratio for each project
        $projects = $projects->map(function ($project) {
             $now = Carbon::now();
            $dueDate = Carbon::parse($project->due_date);
            $remainingDays = $dueDate->diffInDays($now, false); // false to get negative values if overdue
            $workload = $project->estimated_workload;
            $project->workload_ratio = $remainingDays / ($workload > 0 ? $workload : 1); // Avoid division by zero
            $project->random_color = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // Assign a random color
            return $project;
        });

        // Sort the projects by workload ratio in ascending order and get the top 5
        $topProjects = $projects->sortByDesc('workload_ratio')->take(5);
        $taskCount = \App\Models\Task::whereHas('users', function ($query) use ($authUser) {
            $query->where('user_id', $authUser->id);
        })->count();
    
        return view('dashboard', ['topProjects' => $topProjects, 'taskCount' => $taskCount]);
    }
}
