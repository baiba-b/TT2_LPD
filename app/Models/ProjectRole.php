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
        return $this->belongsToMany(User::class, 'project_user', 'roleID', 'userID')
                    ->withPivot('projectID')
                    ->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user', 'roleID', 'projectID')
                    ->withPivot('userID')
                    ->withTimestamps();
    }
}
