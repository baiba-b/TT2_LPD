<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class MessageController extends Controller
{
    public function show(User $user)
    {
        $currentUser = Auth::user();

        // Check if they are mutually connected
        $connections = $currentUser->connections()->get();
        $connectedTo = $currentUser->connectedTo()->get();
        $mutualConnections = $connections->intersect($connectedTo);

        if (!$mutualConnections->contains($user)) {
            return redirect()->route('connections.index');
        }

        // Fetch messages between the users
        $messages = Message::where(function ($query) use ($currentUser, $user) {
            $query->where('user_id', $currentUser->id)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($currentUser, $user) {
            $query->where('user_id', $user->id)
                ->where('receiver_id', $currentUser->id);
        })->get();

        return view('messages.show', compact('user', 'messages'));
    }

    public function store(Request $request, User $user)
{
    $currentUser = Auth::user();
    $connections = $currentUser->connections()->get();
    $connectedTo = $currentUser->connectedTo()->get();
    $mutualConnections = $connections->intersect($connectedTo);

    if (!$mutualConnections->contains($user)) {
        return redirect()->route('connections.index');
    }

    $request->validate([
        'message' => 'required|string|max:1000',
    ]);

    Message::create([
        'user_id' => $currentUser->id,
        'receiver_id' => $user->id,
        'content' => $request->message,
    ]);

    return redirect()->route('messages.show', $user->id);
}

}
