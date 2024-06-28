<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TaskRole;


class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','estimated_workload','due_date','project_id', 'invested_time','creator_id'];

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id')
                ->withPivot('role_id')
                ->withTimestamps();
}

    public function roles()
    {
        return $this->belongsToMany(TaskRole::class, 'task_user', 'task_id', 'role_id')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    
}
