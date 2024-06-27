<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;


class ProjectRole extends Model
{
    use HasFactory;
    protected $fillable = ['role_name', 'read', 'write', 'update', 'notify'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user', 'role_id', 'user_id')
                    ->withPivot('project_id')
                    ->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user', 'role_id', 'project_id')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }
}
