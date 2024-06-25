<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskRole extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'read', 'write', 'mark_complete', 'update'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user', 'roleID', 'taskID')
                    ->withPivot('userID')
                    ->withTimestamps();
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'roleID', 'userID')
                    ->withPivot('taskID')
                    ->withTimestamps();
    }
}
