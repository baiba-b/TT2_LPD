<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'read_at', 'received_at','sender_id'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receivers()
    {
        return $this->belongsToMany(User::class, 'notification_user', 'user_id','notification_id')->withTimestamps();
    }
}
