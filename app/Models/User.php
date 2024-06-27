<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Project;
use App\Models\Task;
use App\Models\ProjectRole;
use App\Models\TaskRole;
use App\Models\Notification;
use App\Models\Message;



class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id')
                    ->withPivot('role_id')
                    ->withTimestamps();
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user', 'user_id', 'task_id')
                    ->withPivot('role_id')
                    ->withTimestamps();
    }

    public function projectRoles()
    {
        return $this->belongsToMany(ProjectRole::class, 'project_user', 'user_id', 'role_id')
                    ->withPivot('project_id')
                    ->withTimestamps();
    }

    public function taskRoles()
    {
        return $this->belongsToMany(TaskRole::class, 'task_user', 'user_id', 'role_id')
                    ->withPivot('task_id')
                    ->withTimestamps();
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_receive', 'user_id', 'notification_id')
                    ->withTimestamps();
    }

    public function connections()
    {
        return $this->belongsToMany(User::class, 'connections', 'user_id', 'connected_user_id')
                    ->withPivot('status', 'type')
                    ->withTimestamps();
    }

    public function connectedTo()
    {
        return $this->belongsToMany(User::class, 'connections', 'connected_user_id', 'user_id')
                    ->withPivot('status', 'type')
                    ->withTimestamps();
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function tasksCreator()
    {
        return $this->hasMany(Task::class, 'creator_id');
    }

    public function projectsCreator()
    {
        return $this->hasMany(Project::class, 'creator_id');
    }
}
