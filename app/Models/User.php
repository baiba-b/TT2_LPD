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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user', 'userID', 'projectID')
                    ->withPivot('roleID')
                    ->withTimestamps();
    }
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user', 'userID', 'taskID')
                    ->withPivot('roleID')
                    ->withTimestamps();
    }
    public function projectRoles()
    {
        return $this->belongsToMany(ProjectRole::class, 'project_user', 'userID', 'roleID')
                    ->withPivot('projectID')
                    ->withTimestamps();
    }
    public function taskRoles()
    {
        return $this->belongsToMany(TaskRole::class, 'task_user', 'userID', 'roleID')
                    ->withPivot('taskID')
                    ->withTimestamps();
    }
    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_receive', 'userID', 'notificationID')
                    ->withTimestamps();
    }
    public function connections()
    {
        return $this->belongsToMany(User::class, 'connections', 'userID', 'connected_userID')
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
}
