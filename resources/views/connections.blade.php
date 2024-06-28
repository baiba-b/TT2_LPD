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
            <li><a href="{{url('/Timeline')}}">Timeline</a></li>
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
                        </div>
                        <a href="{{ route('messages.show', $connection->id) }}" class="connect-button">Message</a>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="section">
            <h2>Users You've Added</h2>
            @if($connections->isEmpty())
                <p>You have not added any users yet.</p>
            @else
                @foreach($connections as $connection)
                    @if(!$mutualConnections->contains($connection))
                        <div class="connection">
                            <img src="{{ $connection->profile_picture }}" alt="{{ $connection->name }}" class="profile-picture">
                            <div class="user-info">
                                <h3>{{ $connection->name }}</h3>
                                <p>{{ $connection->email }}</p>
                            </div>
                            <a href="{{ route('messages.show', $connection->id) }}" class="connect-button">Message</a>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="section">
            <h2>Users Who Have Added You</h2>
            @if($connectedTo->isEmpty())
                <p>No users have added you yet.</p>
            @else
                @foreach($connectedTo as $connection)
                    @if(!$mutualConnections->contains($connection))
                        <div class="connection">
                            <img src="{{ $connection->profile_picture }}" alt="{{ $connection->name }}" class="profile-picture">
                            <div class="user-info">
                                <h3>{{ $connection->name }}</h3>
                                <p>{{ $connection->email }}</p>
                            </div>
                            <a href="{{ route('messages.show', $connection->id) }}" class="connect-button">Message</a>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>
