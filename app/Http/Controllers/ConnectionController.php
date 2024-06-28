<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        // Get connections where the user is either user_id or connected_userID
        $connections = $user->connections()->get();
        $connectedTo = $user->connectedTo()->get();
        $mutualConnections = $connections->intersect($connectedTo);
        $allUsers = User::where('id', '!=', $user->id)->orderBy('name')->get();
        return view('connections', compact('mutualConnections', 'connections', 'connectedTo', 'allUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'connected_userID' => 'required|exists:users,id',
            'type' => 'required|in:acquaintance,friend',
        ]);

        $user = Auth::user();

        // Check if the connection already exists
        if ($user->connectedTo()->where('connected_userID', $request->connected_userID)->exists()) {
            return redirect()->route('connections.index');
        }

        // Add the connection
        $user->connections()->attach($request->connected_userID, ['type' => $request->type]);

        return redirect()->route('connections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        $currentUser->connections()->detach($user->id);
        $currentUser->connectedTo()->detach($user->id);

        return redirect()->route('connections.index');
    }
}
