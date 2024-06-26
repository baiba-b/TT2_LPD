<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\connectionsStylesheet.css">
    <link rel="stylesheet" href="\css\navbarStylesheet.css">
    <title>Connections</title>
</head>
<body>
<nav>
        <ul>

            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a class="active" href="{{ route('connections.index') }}">Connections</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
            <li><a href="{{ route('tasks.index') }}">Tasks</a></li>
            <li>
                <a href="{{ url('/profile') }}" id="profile-info">
                    @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="exception" style="width: 35px; height: 35px;">
                    @else
                    <img src="{{ asset('default_profile_picture.png') }}" alt="Default Profile Picture" class="exception" style="width: 35px; height: 35px;">
                    @endif
                    <span class="profile-name">{{ Auth::user()->name }}</span>
                </a>
            </li>

        </ul>
    </nav>
<div class="container">
        <div class="section">
            <h2>Mutual Connections</h2>
            @if($mutualConnections->isEmpty())
                <p>You have no mutual connections yet.</p>
            @else
                @foreach($mutualConnections as $connection)
                    <div class="connection">
                        <img src="{{ $connection->profile_picture }}" alt="{{ $connection->name }}" class="profile-picture">
                        <div class="user-info">
                            <h3>{{ $connection->name }}</h3>
                            <p>{{ $connection->email }}</p>
                            <p>{{ $connection->pivot->type }}</p>
                        </div>
                        <a href="{{ route('messages.show', $connection->id) }}" class="connect-button">Message</a>
                        <form action="{{ route('connections.destroy', $connection->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-button">Remove</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="section">
            <h2>Users You've Added</h2>
            @if($connections->isEmpty())
                <p>None</p>
            @else
                @foreach($connections as $connection)
                    @if(!$mutualConnections->contains($connection))
                        <div class="connection">
                            <img src="{{ $connection->profile_picture }}" alt="{{ $connection->name }}" class="profile-picture">
                            <div class="user-info">
                                <h3>{{ $connection->name }}</h3>
                                <p>{{ $connection->email }}</p>
                                <p>{{ $connection->pivot->type }}</p>
                            </div>
                            <form action="{{ route('connections.destroy', $connection->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this connection?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-button">Remove</button>
                        </form>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="section">
            <h2>Users Who Have Added You</h2>
            @if($connectedTo->isEmpty())
                <p>None</p>
            @else
                @foreach($connectedTo as $connection)
                    @if(!$mutualConnections->contains($connection))
                        <div class="connection">
                            <img src="{{ $connection->profile_picture }}" alt="{{ $connection->name }}" class="profile-picture">
                            <div class="user-info">
                                <h3>{{ $connection->name }}</h3>
                                <p>{{ $connection->email }}</p>
                                <p>{{ $connection->pivot->type }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="section">
            <h2>Add New Connection</h2>
            <form action="{{ route('connections.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_id">Select User</label>
                    <select name="connected_userID" id="connected_userID" required>
                        @foreach($allUsers as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Connection Type</label>
                    <select name="type" id="type" required>
                        <option value="acquaintance">Acquaintance</option>
                        <option value="friend">Friend</option>
                    </select>
                </div>
                <button type="submit" class="connect-button">Add Connection</button>
            </form>
        </div>
    </div>
</body>
</html>
