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
    protected $fillable = ['name','description','due_date'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

   public function users()
    {
        return $this->belongsToMany(User::class, 'project_user', 'projectID', 'userID')
                    ->withPivot('roleID')
                    ->withTimestamps();
    }
    public function roles()
    {
        return $this->belongsToMany(ProjectRole::class, 'project_user', 'projectID', 'roleID')
                    ->withPivot('userID')
                    ->withTimestamps();
    }

}
