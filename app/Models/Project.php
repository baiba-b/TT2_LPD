<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;
use App\Models\ProjectRole;



class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'due_date',
        'invested_time',
        'estimated_workload',
        'creator_id'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')
                    ->withPivot('role_id')
                    ->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany(ProjectRole::class, 'project_user', 'project_id', 'role_id')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}