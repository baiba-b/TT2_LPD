<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TaskRole;


class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','estimated_workload','invested_time','due_date','projectID'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projectID');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'taskID', 'userID')
                    ->withPivot('roleID')
                    ->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany(TaskRole::class, 'task_user', 'taskID', 'roleID')
                    ->withPivot('userID')
                    ->withTimestamps();
    }

}
