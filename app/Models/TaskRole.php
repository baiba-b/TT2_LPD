<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;


class TaskRole extends Model
{
    use HasFactory;
    protected $fillable = ['role_name', 'read', 'write', 'mark_complete', 'update'];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'role_id', 'user_id')
                    ->withPivot('task_id')
                    ->withTimestamps();
    }
    
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user', 'role_id', 'task_id')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }
}
