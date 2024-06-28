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
            return redirect()->route('connections.index')->withErrors('You can only message mutually connected users.');
        }

        // Fetch messages between the users
        $messages = Message::where(function ($query) use ($currentUser, $user) {
            $query->where('sender_id', $currentUser->id)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($currentUser, $user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $currentUser->id);
        })->get();
        \Log::debug('Show method called', [
            'currentUser' => $currentUser->id,
            'user' => $user->id,
            'messagesCount' => $messages->count(),
        ]);
        return view('messages.show', compact('user', 'messages'));
    }

    public function store(Request $request, User $user)
{
    $currentUser = Auth::user();
    $connections = $currentUser->connections()->get();
    $connectedTo = $currentUser->connectedTo()->get();
    $mutualConnections = $connections->intersect($connectedTo);

    if (!$mutualConnections->contains($user)) {
        return redirect()->route('connections.index')->withErrors('You can only message mutually connected users.');
    }

    $request->validate([
        'message' => 'required|string|max:1000',
    ]);
    \Log::debug('Show method called', [
        'currentUser' => $currentUser->id,
        'user' => $user->id,
        'messagesCount' => $messages->count(),
    ]);
    Message::create([
        'sender_id' => $currentUser->id,
        'receiver_id' => $user->id,
        'content' => $request->message,
    ]);

    return redirect()->route('messages.show', $user->id);
}

}
