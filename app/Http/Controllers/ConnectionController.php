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
            return redirect()->route('login')->withErrors('You must be logged in to view your connections.');
        }
        // Get connections where the user is either user_id or connected_userID
        $connections = $user->connections()->get();
        $connectedTo = $user->connectedTo()->get();
        $mutualConnections = $connections->intersect($connectedTo);
        $allUsers = User::where('id', '!=', $user->id)->get();
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
        if (
            $user->connections()->where('connected_userID', $request->connected_userID)->exists() ||
            $user->connectedTo()->where('user_id', $request->connected_userID)->exists()
        ) {
            return redirect()->route('connections.index')->withErrors('You are already connected with this user.');
        }

        // Add the connection
        $user->connections()->attach($request->connected_userID, ['type' => $request->type]);

        return redirect()->route('connections.index')->with('success', 'Connection added successfully.');
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
    public function destroy(string $id)
    {
        //
    }
}
